<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-1zcNBiDpM+FxI6pF+n15BzNlj/1e2chFZ0DdytO9+rPqD4H+YrLZeqvZd/qbIgBkd4ipCVjVjxZ0Nz7U52Gr8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #1c1f26;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }

        nav ul li a.active,
        nav ul li a:hover {
            color: #F1C21B;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px;
        }

        .content {
            max-width: 600px;
        }

        .content h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .content h1 {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .content h1 span {
            color: #F1C21B;
        }

        .content p {
            font-size: 1rem;
            color: #ccc;
            margin-bottom: 20px;
        }


        .socials {
    display: flex;
    gap: 15px;
    align-items: center;
}

.socials a {
    color: white;
    background-color: transparent;
    padding: 10px;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.3s;
}

        .socials a:hover {
            background-color: #F1C21B;
            color: #1c1f26;
        }

        .image img {
            max-width: 400px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">Dksha</div>
        <nav>
            <ul>
                <li><a href="/index.php?action=home" class="active">Home</a></li>
                <li><a href="/index.php?action=feedback">Feedback</a></li>
                <li><a href="/index.php?action=login">Log in</a></li>
                <li><a href="/index.php?action=signup">SignUp</a></li>
                <li><a href="/index.php?action=logout">Logout</a></li>

            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="content">
            <h3>Hi, It's Me</h3>
            <h1>I'm <span>Diksha!</span></h1>
            <p>An undergraduate Bachelors in Computer Science Student who recently completed her second year.</p>
            <div class="socials">
                <a href="https://github.com/dkshamhrzn"><img src="/git.png" height="35px" width="60px"></a>
                <a href="https://www.instagram.com/_.dkshaaa._/"><img src="/insta.png" height="50px" width="50px"> </a>
                <a href="https://www.linkedin.com/in/diksha-maharjan-ab5790244/"><img src="/linkedin.png" height="50px" width="50px"></a>
            </div>
        </div>

        <div class="image">
            <div style="position: relative; width: 300px; height: 300px;">
                <!-- SVG in the back -->
                <svg viewBox="0 0 200 200" width="700" height="700" xmlns="http://www.w3.org/2000/svg"
                    style="position: absolute; top: 0; left:-200; z-index: 0;">
                    <path fill="#F1C21B"
                        d="M22.1,-43.3C27.7,-34.9,30.9,-27.3,33.5,-20.2C36,-13.1,38,-6.6,41,1.7C43.9,9.9,47.8,19.9,45,26.6C42.2,33.4,32.8,36.9,24.2,45.6C15.6,54.3,7.8,68.2,-2.8,73C-13.4,77.9,-26.8,73.8,-38,66.6C-49.3,59.4,-58.3,49.1,-67.8,37.5C-77.3,25.9,-87.3,13,-84.2,1.8C-81.1,-9.4,-64.9,-18.8,-53.5,-27.1C-42.1,-35.4,-35.4,-42.6,-27.3,-49.6C-19.2,-56.5,-9.6,-63.2,-0.7,-62C8.2,-60.8,16.4,-51.7,22.1,-43.3Z"
                        transform="translate(100 100)" />
                </svg>

                <!-- Image in front -->
                <img src="/photo.png" alt="Profile Image"
                    style="position: absolute; top: 0; left: -80px; width: 600px; height: 600px; z-index: 1;" />
            </div>

        </div>




    </section>
</body>

</html>