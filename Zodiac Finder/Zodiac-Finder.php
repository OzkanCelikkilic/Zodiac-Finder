<!DOCTYPE html>
<html>
<head>
    <title>Web Programming Project</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <?php
    
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        
        $day = sanitizeInput($_POST["day"]);
        $month = sanitizeInput($_POST["month"]);
        $year = sanitizeInput($_POST["year"]);

     
        $birthDate = strtotime($year . "-" . $month . "-" . $day);
        $currentDate = time();
        $ageInDays = floor(($currentDate - $birthDate) / (60 * 60 * 24));

       
        $zodiacSign = determineZodiacSign($month, $day);

        
        $currentDateTime = date("d.m.Y H:i");


        
     $fileName = "USER.TXT";
                    $fileContent = file_get_contents($fileName);
                    $nameParts = explode(" ", $fileContent);
                    $firstName = isset($nameParts[0]) ? $nameParts[0] : "";
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : "";
                   
        $fileContent .= "\nDate of Birth: " . $day . "." . $month . "." . $year . "\n";
        $fileContent .= "Zodiac Sign: " . $zodiacSign . "\n";
        $fileContent .= "Today's Date and Time: " . $currentDateTime . "\n";
        $fileContent .= "Information about Zodiac Sign: " . getZodiacSignInformation($zodiacSign) . "\n";
        $fileContent .= "Days You Have Lived: " . $ageInDays . " days";

        
        $fileName = "About_U.txt";
        file_put_contents($fileName, $fileContent);
    }
    

    
    function determineZodiacSign($month, $day) {
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
            return "Aquarius";
        } elseif (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
            return "Pisces";
        } elseif (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
            return "Aries";
        } elseif (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
            return "Taurus";
        } elseif (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) {
            return "Gemini";
        } elseif (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) {
            return "Cancer";
    } elseif (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
        return "Leo";
    } elseif (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
        return "Virgo";
    } elseif (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) {
        return "Libra";
    } elseif (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) {
        return "Scorpio";
    } elseif (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) {
        return "Sagittarius";
    } elseif (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
        return "Capricorn";
    } else {
        return "";
    }


        $birthdate = $month . "-" . $day;
        foreach ($zodiacSigns as $sign => $dateRange) {
            $start = strtotime($dateRange[0]);
            $end = strtotime($dateRange[1]);
            $birthdateTimestamp = strtotime($birthdate);
            if (($birthdateTimestamp >= $start) && ($birthdateTimestamp <= $end)) {
                return $sign;
            }
        }

        return "";
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table>
            <tr>
                <td>My name is:</td>
                <td colspan="2">
                    <?php
                    
                    $fileName = "USER.TXT";
                    $fileContent = file_get_contents($fileName);
                    $nameParts = explode(" ", $fileContent);
                    $firstName = isset($nameParts[0]) ? $nameParts[0] : "";
                    $lastName = isset($nameParts[1]) ? $nameParts[1] : "";
                    echo $firstName . " " . $lastName;
                    ?>
                </td>
            </tr>
            <tr>
                <td>My birthday is:</td>
                <td>
                    <select name="day">
                        <?php
                        
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="month">
                        <?php
                        
                        $months = array(
                            1 => "January",
                            2 => "February",
							3 => "March",
							4 => "April",
							7 => "May",
							5 => "June",
							6 => "July",
							8 => "August",
							9 => "September",
							10 => "October",
							11 => "November",
							12 => "December",
                           
                        );
                        foreach ($months as $monthNumber => $monthName) {
                            echo "<option value=\"$monthNumber\">$monthName</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="year">
                        <?php
                        
                        for ($i = 1970; $i <= 2023; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>My Zodiac sign is:</td>
                <td colspan="2">
                    <?php
                    
                    echo determineZodiacSign($month, $day);
                    ?>
                </td>
            </tr>
            <tr>
                <td>Now is:</td>
                <td colspan="2">
                    <?php
                    
                    echo date("d.m.Y H:i");
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
    <?php
    
    $zodiacSign = determineZodiacSign($month, $day);

   
    $imagePath = "Pictures_JPG/" . strtolower($zodiacSign) . ".jpg";

    
    echo '<img src="' . $imagePath . '" alt="Zodiac Sign">';
    ?>
</td>

            </tr>
            <tr>
                <td colspan="3">
    <?php
    
    function getZodiacSignInformation($zodiacSign) {
        $fileName = "point.txt";
        $fileContent = file_get_contents($fileName);

       
        $startTag = "<" . $zodiacSign . ">";
        $endTag = "</" . $zodiacSign . ">";
        $startPos = strpos($fileContent, $startTag);
        $endPos = strpos($fileContent, $endTag);

        if ($startPos !== false && $endPos !== false) {
           
            $information = substr($fileContent, $startPos + strlen($startTag), $endPos - $startPos - strlen($startTag));
            
            $information = strip_tags($information);
            return $information;
        }

        return "";
    }

   
    echo getZodiacSignInformation($zodiacSign);
    ?>
</td>

            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="clear" value="Clear">
               
