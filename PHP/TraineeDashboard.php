<!--HTML-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trainee Dashboard</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/TraineeDashboardCSS.css" />
    <link rel="stylesheet" href="../FitManage_CSS.css" />
</head>
<body>
    <header>
        <div class="header-background4"></div>
        <h1 class="main-title">Trainee Dashboard</h1>
        <img src="../images/FitManageLogo.jpg" alt="Site Logo">
    </header>

    <nav>
        <a href="../index.html">Home Page</a> 
        <a href="../HrefPages/Register.html">Register here</a>
        <a href="../PHP/classSchedule.php">Class Schedule</a>  
        <a href="../PHP/AddClass.php">Trainer Dashboard</a> 
        <a href="../PHP/adminPanel.php">Admin Panel</a>  
        <a href="../HrefPages/AboutUs.html">About Us</a> 
    </nav>

    <section class="external-links">
        <h2>Helpful External Resources for Trainees</h2>
        <ol>
            <li>
                <a href="https://www.ncsf.org/pdf/downloads/medical_clearance_form.pdf" target="_blank">
                    Medical approval form to be signed by a doctor before starting any training
                </a>
            </li>
            <li>
                <a href="https://www.youtube.com/watch?v=AGj7wEn1jLo" target="_blank">
                    Pre-workout stretching routine (watch the video)
                </a>
            </li>
            <li>
                <a href="https://www.nutrition.gov/topics/basic-nutrition" target="_blank">
                    General nutrition guidelines for fitness (Academy of Nutrition and Dietetics)
                </a>
            </li>
        </ol>
    </section>

    <section class="external-links">
        <h2>BMI Calculator</h2>
        <form method="POST">
            <label>Full Name:</label>
            <input type="text" name="name" required><br>

            <label>Age:</label><!--min:1 , max:120 -->
            <input type="number" name="age" min="1" max="120" required><br>

            <label>Height (cm):</label><!--min:50cm , max:250cm -->
            <input type="number" name="height" min="50" max="250" required><br>

            <label>Weight (kg):</label> <!--min:10kg , max:200kg -->
            <input type="number" name="weight" min="10" max="200"required><br>

            <button type="submit">Calculate BMI</button>
        </form>

                    <!-- PHP functionalty -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Func calc for BMI
                function calculateBMI($height_cm, $weight_kg) {
                    $height_m = $height_cm / 100;
                    return $weight_kg / ($height_m * $height_m);
                }

                // Get from user
                $name = $_POST['name'];
                $age = $_POST['age'];
                $height = $_POST['height'];
                $weight = $_POST['weight'];

                // CALC BMI
                $bmi = calculateBMI($height, $weight);
                $bmiRounded = round($bmi, 2);

                // Array Categories
                $categories = [
                    "Underweight" => [0, 18.4],
                    "Normal weight" => [18.5, 24.9],
                    "Overweight" => [25.0, 29.9],
                    "Obesity" => [30.0, 100]
                ];

                // Find which Category (loop..)
                $category = "Unknown";
                foreach ($categories as $label => $range) {
                    if ($bmi >= $range[0] && $bmi <= $range[1]) {
                        $category = $label;
                        break;
                    }
                }

                // toUpper (getting big letters)
                $nameUpper = strtoupper($name);

                // out put for user
                echo "<div class='bmi-result'>";
                echo "<h3>Hello $nameUpper (Age: $age ,height: $height [cm] ,weight: $weight [Kg])</h3>";
                echo "<p>Your BMI is <strong>$bmiRounded</strong></p>";
                echo "<p>You are classified as: <strong>$category</strong></p>";
                echo "</div>";
            }
            ?>
    <section>
</body>
</html>

