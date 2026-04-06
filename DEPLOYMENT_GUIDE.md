# TaskPilot Deployment Guide for InfinityFree

InfinityFree is a free web hosting platform that supports PHP and MySQL, making it perfect for hosting our CodeIgniter 3 TaskPilot application.

Follow these step-by-step instructions to get your app live on the internet!

## Step 1: Prepare Your Files for Upload
1. Open your project folder located at `d:\PROJECTS@@\TaskPilot`.
2. Select all the files **inside** the `TaskPilot` folder (the `application`, `system`, `index.php`, etc.).
3. Right-click and choose **Compress to ZIP file**. Name the file `taskpilot.zip`.

## Step 2: Create an InfinityFree Account & Hosting Account
1. Go to [InfinityFree.net](https://infinityfree.net/) and click **Sign Up**.
2. Verify your email address and log in to the Client Area.
3. Click the **Create Account** button.
4. Choose a free subdomain (e.g., `taskpilot.epizy.com` or `mypharmacy.rf.gd`) and click **Search Domain**.
5. Enter an Account Label and Password, then click **Create Account**.
6. Wait a few minutes for the account to be set up, then click **Open Control Panel** (approve the "I Approve" notice if it appears).

## Step 3: Setup the Database
1. In the InfinityFree Control Panel (VistaPanel), scroll down to the **DATABASES** section.
2. Click on **MySQL Databases**.
3. Create a new database named `taskpilot` (InfinityFree will automatically add a prefix, so it will look like `epiz_12345678_taskpilot`).
4. **Note down these details carefully:**
   - Database Name: (e.g., `epiz_12345678_taskpilot`)
   - MySQL Username: (e.g., `epiz_12345678`)
   - MySQL Password: (Found in your Client Area or Control Panel)
   - MySQL Host Name: (e.g., `sql123.epizy.com`)

## Step 4: Import the SQL File
1. Go back to the Control Panel main page and click on **phpMyAdmin**.
2. Click **Connect Now** next to your newly created database.
3. In phpMyAdmin, click the **Import** tab at the top.
4. Click **Choose File** and select the `database.sql` file located in `d:\PROJECTS@@\TaskPilot\database.sql`.
5. Scroll down to the bottom and click **Go**.
6. You should see a green success message saying the tables were created successfully.

## Step 5: Upload Your Files
1. Go back to the Client Area for your hosting account and click **File Manager** (or use an FTP client like FileZilla).
2. Open the `htdocs` folder. **Delete** any existing files inside `htdocs` (like `index2.html`).
3. Click the **Upload** icon (usually at the bottom) and choose **Upload Zip**.
4. Select your `taskpilot.zip` file. The File Manager will automatically upload and extract your files into the `htdocs` folder.

## Step 6: Update Database Configuration
CodeIgniter needs to know the credentials for your live InfinityFree database.

1. In the InfinityFree File Manager, navigate to `htdocs/application/config/database.php`.
2. Right-click the file and select **Edit**.
3. Scroll down to line 79 where you see:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'taskpilot',
```
4. Change those 4 lines to match the details you noted down in Step 3. For example:
```php
'hostname' => 'sql123.epizy.com',
'username' => 'epiz_12345678',
'password' => 'your_actual_password_here',
'database' => 'epiz_12345678_taskpilot',
```
5. Click **Save**.

## Step 7: Update Base URL Configuration
CodeIgniter needs to know its live URL.

1. Navigate to `htdocs/application/config/config.php` and click **Edit**.
2. Find line 26:
```php
$config['base_url'] = 'http://localhost/TaskPilot/';
```
3. Change `http://localhost/TaskPilot/` to your live URL. Ensure it ends with a slash `/`. For example:
```php
$config['base_url'] = 'http://taskpilot.epizy.com/';
```
4. Click **Save**.

## Step 8: Login and Test
1. Open a new web browser tab.
2. Go to your live URL (e.g., `http://taskpilot.epizy.com/`).
3. You should see the TaskPilot Login screen!
4. Log in using the default credentials:
   - **Email:** `admin@taskpilot.local`
   - **Password:** `password`

Congratulations! Your application is now live on the web!
