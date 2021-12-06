## Test Your Laravel File Upload Skills

This repository is a test for you: perform a set of tasks listed below, and fix the PHPUnit tests, which are currently intentionally failing.

To test if all the functions work correctly, there are PHPUnit tests in `tests/Feature/FileUploadTest.php` file.

In the very beginning, if you run `php artisan test`, or `vendor/bin/phpunit`, all tests fail.
Your task is to make those tests pass.

## How to Submit Your Solution

If you want to submit your solution, you should make a Pull Request to the `main` branch.
It will automatically run the tests via GitHub Actions and will show you/me if the test pass.

If you don't know how to make a Pull Request, [here's my video with instructions](https://www.youtube.com/watch?v=vEcT6JIFji0).

This task is mostly self-served, so I'm not planning review or merge the Pull Requests. This test is for yourselves to assess your skills, the automated tests will be your answer if you passed the test :)


## Questions / Problems?

If you're struggling with some tasks, or you have suggestions how to improve the task, create a GitHub Issue.

Good luck!

---

## Task 1. Original Filename.

In `app/Http/Controllers/ProjectController.php` file, in the `store()` method, get the original filename, to later save it to the DB.

Test method `test_original_filename_upload()`.

---

## Task 2. File Size Validation.

In `app/Http/Controllers/ProjectController.php` file, in the `store()` method, put in the validation rule so "logo" file would be MAX 1 megabyte

Test method `test_file_size_validation()`.

---

## Task 3. Update: Delete Old File

In `app/Http/Controllers/HouseController.php` file, in the `update()` method, we upload the new file but don't delete the old one. Help to clean up the disk and delete the old file.

Test method `test_update_file_remove_old_one()`.

---

## Task 4. Download the Uploaded File

In `app/Http/Controllers/HouseController.php` file, in the `download()` method, return the response that would automatically download the file with `$house->photo` filename from `storage/app/houses` folder.

Test method `test_download_uploaded_file()`.

---

## Task 5. Upload File to Public

In `app/Http/Controllers/OfficeController.php` file, in the `store()` method, upload the file to the "public" disk, to its "offices" folder. The test asserts that the file exists in the respected location, and is shown in the offices/show.blade.php

Test method `test_public_file_show()`.

---

## Task 6. Resize Image with Intervention/Image

In `app/Http/Controllers/ShopController.php` file, in the `store()` method, the uploaded image file needs to be resized to 500x500 and stored in /storage/app/shops/resized-$filename. Use intervention/image package, it's already pre-installed for you.

Test method `test_upload_resize()`.

---

## Task 7. Spatie Media Library

In `app/Http/Controllers/CompanyController.php` file, in the `show()` method, use Spatie Media Library package methods to get the full URL of the file that was just uploaded.

Test method `test_spatie_media_library()`.

---

