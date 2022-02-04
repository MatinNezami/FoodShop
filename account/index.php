<?php
    
    require_once "../share/component.php";

    function profile (int $index) {
        $length = $index + 3;
        for ($index; $index <= $length; $index++) {
            if ($index % 2 == 0)
                echo '<img src="/images/profile/profile' . $index . '.jpeg" alt="profile" draggable="false"></div>';

            else
                echo '<div class="center-item"><img src="/images/profile/profile' . $index . '.jpeg" alt="profile" draggable="false">';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>

    <?php component::headFiles() ?>

    <script>
        <?php
            if (isset($_GET["login"]))
                echo "const flag = \"login\"";

            elseif (isset($_GET["signup"]))
                echo "const flag = \"signup\"";
        ?>
    </script>
</head>

<body>
    <!-- <img src="../images/account.jpg" alt="background picture"> -->
    <div></div>
    <header>
        <?php component::navbar() ?>
    </header>

    <main class="center-item">
        <div class="center-item" id="signup-box">
            <img src="/images/register.jpg" alt="signup picture" draggable="false">

            <div class="input">
                <input type="text" class="username" autocomplete="off">
                <p data-text="Username" data-require class="placeholder">Username</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <g fill="none" stroke="#000" stroke-width="5" stroke-linecap="round">
                        <circle cx="50" cy="25" r="20"/>
                        <path d="M 10 85 C 30 50 70 50 90 85"/>
                    </g>
                </svg>
            </div>

            <div class="input">
                <input type="email" class="email" autocomplete="off">
                <p data-text="Email" data-require class="placeholder">Email</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M3.84674576,17.8602756 C4.0442161,17.955959 4.26584099,18.0096122 4.49999728,18.0096122 L19.5,18.0096122 C19.734157,18.0096122 19.9557825,17.9559587 20.1532533,17.8602747 L14.2446247,12.2992125 L12.3178536,13.8859651 C12.1332257,14.0380116 11.8667743,14.0380116 11.6821464,13.8859651 L9.75537533,12.2992125 L3.84674576,17.8602756 L3.84674576,17.8602756 Z M3.1430925,17.1498223 C3.1477226,17.1451097 3.15246435,17.1404678 3.15731765,17.1359 L8.97720082,11.6583629 L3.18214637,6.88596512 C3.16950983,6.87555855 3.15751523,6.86466152 3.14616744,6.85332433 C3.05246763,7.04913384 2.99999728,7.26843937 2.99999728,7.5 L2.99999728,16.5096122 C2.99999728,16.7386275 3.05132045,16.9556556 3.1430925,17.1498223 L3.1430925,17.1498223 Z M20.8569057,17.1498204 C20.9486772,16.9556542 21,16.7386268 21,16.5096122 L21,7.5 C21,7.26844009 20.94753,7.04913522 20.8538307,6.85332617 C20.8424835,6.86466269 20.8304895,6.87555911 20.8178536,6.88596512 L15.0227992,11.6583629 L20.8426823,17.1359 C20.847535,17.1404672 20.8522762,17.1451085 20.8569057,17.1498204 L20.8569057,17.1498204 Z M20.1444281,6.14509696 C19.9491886,6.05206979 19.7306751,6 19.5,6 L4.49999728,6 C4.26932289,6 4.05080997,6.05206949 3.85557086,6.14509614 L12,12.8522731 L20.1444281,6.14509696 L20.1444281,6.14509696 Z M4.49999728,5 L19.5,5 C20.8807119,5 22,6.11928813 22,7.5 L22,16.5096122 C22,17.8903241 20.8807119,19.0096122 19.5,19.0096122 L4.49999728,19.0096122 C3.11928541,19.0096122 1.99999728,17.8903241 1.99999728,16.5096122 L1.99999728,7.5 C1.99999728,6.11928813 3.11928541,5 4.49999728,5 Z"/>
                </svg>

            </div>

            <div class="input">
                <input type="password" class="password" data-type="password" autocomplete="off">
                <p data-text="Password" data-require class="placeholder">Password</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <g fill="none" stroke="#000" stroke-width="5" stroke-linecap="round">
                        <path d="M 25 35 C 25 0 75 0 75 35"/>
                        <rect x="20" y="40" width="60" height="50" rx="8" ry="8"/>
                        <circle cx="50" cy="65" r="5"/>
                    </g>
                </svg>
            </div>

            <div class="input">
                <input type="password" class="retry-password" data-type="password" autocomplete="off">
                <p data-text="Retry Password" data-require class="placeholder">Retry Password</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <g fill="none" stroke="#000" stroke-width="5" stroke-linecap="round">
                        <path d="M 25 35 C 25 0 75 0 75 35"/>
                        <rect x="20" y="40" width="60" height="50" rx="8" ry="8"/>
                        <circle cx="50" cy="65" r="5"/>
                    </g>
                </svg>
            </div>

            <div class="show-password center-item">
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
            </div>

            <button class="profile">Select A Profile</button>

            <div class="profile-images center-item">
                <div class="center-item">
                    <?php profile(1) ?>
                </div>

                <div class="center-item">
                    <?php profile(5) ?>
                </div>
            </div>

            <input type="file" id="custom-profile">

            <img src="" alt="custom profile" draggable="false" id="custom-profile-image">

            <label for="custom-profile" class="center-item">Select A Custom Profile</label>

            <div class="control center-item">
                <button class="login">Login</button>
                <button class="submit">Submit</button>
            </div>
        </div>

        <div class="center-item" id="login-box">
            <img src="/images/login.webp" alt="login picture" draggable="false">

            <div class="input">
                <input type="text" class="username" autocomplete="off">
                <p data-text="Username" data-require class="placeholder">Username</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <g fill="none" stroke="#000" stroke-width="5" stroke-linecap="round">
                        <circle cx="50" cy="25" r="20"/>
                        <path d="M 10 85 C 30 50 70 50 90 85"/>
                    </g>
                </svg>
            </div>

            <div class="input">
                <input type="password" class="password" data-type="password" autocomplete="off">
                <p data-text="Password" data-require class="placeholder">Password</p>

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                    <g fill="none" stroke="#000" stroke-width="5" stroke-linecap="round">
                        <path d="M 25 35 C 25 0 75 0 75 35"/>
                        <rect x="20" y="40" width="60" height="50" rx="8" ry="8"/>
                        <circle cx="50" cy="65" r="5"/>
                    </g>
                </svg>
            </div>

            <div class="show-password center-item">
                <input type="checkbox" autocomplete="off">
                <p>Show Password</p>
            </div>

            <button class="login-google">With Google</button>

            <div class="control center-item">
                <button class="signup">Sign Up</button>
                <button class="submit">Submit</button>
            </div>
        </div>
    </main>

    <?php component::asideMenu() ?>

    <script type="text/javascript" src="../share/app.js"></script>
    <script type="text/javascript" src="./main.js"></script>
</body>

</html>