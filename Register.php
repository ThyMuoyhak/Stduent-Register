<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch provinces and their districts
$sql = "SELECT p.id AS province_id, p.province_name, d.district_name 
        FROM provinces p 
        LEFT JOIN districts d ON p.id = d.province_id";
$result = $conn->query($sql);

$provinces = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $provinces[$row['province_name']][] = $row['district_name'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    body {
        background: black;
        background-size: 400% 400%;
        animation: gradientAnimation 15s ease infinite;
    }
   
</style>

    <script>
        var districts = <?php echo json_encode($provinces); ?>;

        // Update districts based on selected province
        function updateDistricts() {
            var province = $("#province").val();
            var districtSelect = $("#district");
            districtSelect.empty();
            if (province && districts[province]) {
                districtSelect.append(new Option("Select a district", ""));
                districts[province].forEach(function(district) {
                    districtSelect.append(new Option(district, district));
                });
            } else {
                districtSelect.append(new Option("No districts available", ""));
            }
        }

        // Form validation function
        function validateForm() {
            var name = $("input[name='name']").val();
            var gender = $("select[name='gender']").val();
            var dob = $("input[name='dob']").val();
            var province = $("select[name='province']").val();
            var district = $("select[name='district']").val();

            if (!name || !gender || !dob || !province || !district) {
                alert("Please fill in all required fields.");
                return false;
            }
            return true;
        }

        // Handle form submission via AJAX
        $(document).ready(function() {
            $(".submit-btn").on("click", function(event) {
                event.preventDefault(); // Prevent default button action
                
                // Validate form before submitting
                if (!validateForm()) {
                    return;
                }

                var formData = $("form").serialize();

                $.ajax({
                    url: "submit_student.php",  // PHP file to handle form submission
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#message").html(response); // Display success or failure message
                    },
                    error: function() {
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            AOS.init(); // Initialize AOS animations
        });
    </script>
</head>
<body class="text-white flex items-center justify-center min-h-screen">
    <div  id="fm"  class="bg-gray-800/50 p-8 rounded-lg shadow-xl w-full max-w-lg" data-aos="fade-up">
        <h2 class="text-3xl font-semibold text-center mb-6 text-gradient">Student Registration Form</h2>
        <div id="message"></div>
        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="name" class="block text-sm">Name:</label>
                <input type="text" name="name" required class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
            </div>

            <div>
                <label for="gender" class="block text-sm">Gender:</label>
                <select name="gender" class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div>
                <label for="dob" class="block text-sm">Date of Birth:</label>
                <input type="date" name="dob" required class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
            </div>

            <div>
                <label for="province" class="block text-sm">Province:</label>
                <select name="province" id="province" onchange="updateDistricts()" class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <option value="">Select a province</option>
                    <?php foreach ($provinces as $province => $districts) {
                        echo "<option value='$province'>$province</option>";
                    } ?>
                </select>
            </div>

            <div>
                <label for="district" class="block text-sm">District:</label>
                <select name="district" id="district" class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <option value="">Select a district</option>
                </select>
            </div>

            <div>
                <label for="note" class="block text-sm">Note:</label>
                <textarea name="note" class="w-full p-4 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"></textarea>
            </div>

            <button type="button" class="submit-btn w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                Submit
            </button>
        </form>
    </div>
    <script>
        AOS.init();
    </script>
</body>
</html>
