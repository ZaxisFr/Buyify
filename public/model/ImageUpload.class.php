<?php


class ImageUpload {
    private static $APPLICATION_PATH = '/home/vagrant/Buyify/public';
    private static $errorMessage;
    private static $newFileName;
    private static $relativePath = 'model/data/images';

    /**
     * Get the error message if there is one
     * @return string
     */
    public static function getErrorMessage() : string {
        return self::$errorMessage;
    }

    /**
     * Get the new file name if it has been created
     * @return string
     */
    public static function getNewFileName() : string {
        return self::$newFileName;
    }

    /**
     * Set the path where to save the image, relative to base folder
     * @param string $newPath
     */
    public static function setRelativePath(string $newPath) {
        while ($newPath[0] == '/') $newPath = substr($newPath, 1);
        self::$relativePath = $newPath;
    }

    /**
     * Get the full path to the folder where the image will be saved
     * @return string
     */
    public static function getFullPath() : string {
        return self::$APPLICATION_PATH . '/' . self::$relativePath . '/';
    }

    /**
     * Upload an image from the user's computer
     * @param array $image The uploaded image to process ($_FILES array)
     * @param int $maxSize The max size (in bytes) of the image
     * @param int $width If positive, the width of the image, returns an error if it doesn't match the file
     * @param int $height If positive, the height of the image, returns an error if it doesn't match the file
     * @return bool True if the image uploaded successfully
     */
    public static function uploadImage(array $image, int $maxSize, int $width = 0, int $height = 0) : bool {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !(isset($image['error']) ||
            is_array($image['error']))
        ) {
            self::$errorMessage = 'parameters';
            echo('test 1');
            return false;
        }

        // Check $_FILES['upfile']['error'] value.
        switch ($image['error']) {
            case UPLOAD_ERR_OK:
              printf("test 12");
                break;
            case UPLOAD_ERR_NO_FILE:
                self::$errorMessage = 'no_file';
                echo('test 2');
                return false;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                self::$errorMessage = 'size';
                echo('test 3');
                return false;
            default:
                self::$errorMessage = 'unknown';
                echo('test 4');
                return false;
        }

        if ($image['size'] > $maxSize) {
            self::$errorMessage = 'size';
            echo('test 5');
            return false;
        }

        if ($width > 0 && $height > 0 && !self::checkImageSize($image['tmp_name'], $width, $height)){
            self::$errorMessage = 'resolution';
            return false;
        }

        if (false === ($ext = self::checkImageFormat($image['tmp_name'])))
            return false;

        if (!self::moveImage($image['tmp_name'], $ext)){
            return false;
        }

        return true;
    }

    /**
     * Retrieve a file from a distant server
     * @param string $url The url to reach
     * @return bool True if the image could be saved on the server
     */
    public static function retrieveImage(string $url) : bool {
        if (!preg_match("/^((http[s]?|ftp):\\/)?\\/?([^:\\/\\s]+)((\\/\\w+)*\\/)([\\w\\-\\.]+[^#?\\s]+)(.*)?(#[\\w\\-]+)?$/", $url)) {
            self::$errorMessage = 'url';
            return false;
        }

        $tempImagePath = self::$APPLICATION_PATH . '/tempImg' . microtime(true) . '.tmp';
        file_put_contents($tempImagePath, fopen($url, 'rb'));

        if (false === ($ext = self::checkImageFormat($tempImagePath))) {
            unlink($tempImagePath);
            return false;
        }

        if (!self::moveImage($tempImagePath, $ext))
            return false;

        return true;
    }

    /**
     * Check if the size of an image is the same as requested
     * @param string $imagePath The path to the image to check
     * @param int $width The requested width of the image
     * @param int $height The requested height of the image
     * @return bool True if the image has the good size
     */
    private static function checkImageSize(string $imagePath, int $width, int $height): bool {
        $imageSize = getimagesize($imagePath);
        return $width === $imageSize[0] && $height === $imageSize[1];
    }

    /**
     * Check if the image has the expected type
     * @param string $imagePath The path to the image
     * @return string|boolean The extension of the image
     */
    private static function checkImageFormat(string $imagePath) {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        if (false === ($ext = array_search(
                $finfo->file($imagePath),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            ))) {
            self::$errorMessage = 'format';
            return false;
        }

        return $ext;
    }

    /**
     * Move the processed image to the upload folder
     * @param string $imagePath The path of the image to move
     * @param string $ext The extension of the result image
     * @return bool True if the file has been moved
     */
    private static function moveImage(string $imagePath, string $ext) : bool {
        self::$newFileName = sha1_file($imagePath) . '.' . $ext;
        $destination = self::getFullPath() . self::$newFileName;

        $isUploaded = is_uploaded_file($imagePath);
        if (($isUploaded && !move_uploaded_file($imagePath, $destination)) ||
            (!$isUploaded && !rename($imagePath, $destination))) {
            self::$errorMessage = 'move';
            return false;
        }

        return true;
    }

?>
