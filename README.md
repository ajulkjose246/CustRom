# CustRom: A Laravel-Powered Hub for Android Custom ROMs

CustRom is an innovative web platform designed to serve as a centralized repository for Android custom ROMs. Built with the robust Laravel framework, this website offers Android enthusiasts a user-friendly interface to browse, download, and stay updated with the latest custom ROMs tailored for a wide range of devices.

# CustRom: Screenshots

![Screen Shot](https://firebasestorage.googleapis.com/v0/b/github-files-akj.appspot.com/o/Imgaes%2FCustRom%2FScreenshot%202024-04-22%20094816.png?alt=media&token=0fb7d443-b4c5-4030-b039-cc556c8449fb)

## Key Features

### Comprehensive Collection
CustRom boasts an extensive library of custom ROMs for various Android devices, ensuring that users can find the ROM they need for their specific model.

### Intuitive Design
The website’s layout is crafted for ease of navigation, allowing users to effortlessly search and locate their desired ROMs.

### Regular Updates
With a commitment to staying current, CustRom regularly updates its ROM listings to include the latest releases and developments in the Android modding community.

### Secure Downloads
Ensuring the integrity of the ROMs, CustRom provides secure download links, giving users peace of mind when customizing their devices.

## Technological Stack

- **Laravel**: Utilizing Laravel’s MVC architecture, CustRom delivers a high-performance experience with efficient routing, session management, and security features.
- **Responsive Design**: The website is fully responsive, offering a seamless experience across desktops, tablets, and mobile devices.

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/ajulkjose246/CustRom.git
    ```

2. Navigate to the project directory:

    ```bash
    cd CustRom
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Install NPM dependencies:

    ```bash
    npm install
    ```

5. Set up the environment variables:

    ```bash
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials and other settings.

6. Generate the application key:

    ```bash
    php artisan key:generate
    ```

7. Run database migrations:

    ```bash
    php artisan migrate
    ```

8. Start the development server:
