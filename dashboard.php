<?php
// Ensure session_start() is the very first thing output.
// The existing session_start() inside the body will be removed by this change.
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Plus+Jakarta+Sans%3Awght%40400%3B500%3B700%3B800"
    />

    <title>Stitch Design</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <div
      class="relative flex size-full min-h-screen flex-col bg-[#211612] dark group/design-root overflow-x-hidden"
      style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'
    >
      <div class="layout-container flex h-full grow flex-col">
        <div class="gap-1 px-6 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-80">
            <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#211612] p-4">
              <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                  <h1 class="text-white text-base font-medium leading-normal">Barber Shop</h1>
                  <p class="text-[#c5a296] text-sm font-normal leading-normal">Admin</p>
                </div>
                <div class="flex flex-col gap-2">
                  <a href="dashboard.php" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#452e26] hover:bg-opacity-80">
                    <div class="text-white" data-icon="House" data-size="24px" data-weight="fill">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M224,115.55V208a16,16,0,0,1-16,16H168a16,16,0,0,1-16-16V168a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v40a16,16,0,0,1-16,16H48a16,16,0,0,1-16-16V115.55a16,16,0,0,1,5.17-11.78l80-75.48.11-.11a16,16,0,0,1,21.53,0,1.14,1.14,0,0,0,.11.11l80,75.48A16,16,0,0,1,224,115.55Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Dashboard</p>
                  </a>
                  <a href="appointments.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="Calendar" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-96-88v64a8,8,0,0,1-16,0V132.94l-4.42,2.22a8,8,0,0,1-7.16-14.32l16-8A8,8,0,0,1,112,120Zm59.16,30.45L152,176h16a8,8,0,0,1,0,16H136a8,8,0,0,1-6.4-12.8l28.78-38.37A8,8,0,1,0,145.07,132a8,8,0,1,1-13.85-8A24,24,0,0,1,176,136,23.76,23.76,0,0,1,171.16,150.45Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Appointments</p>
                  </a>
                  <a href="servizi.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="Scissors" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M157.73,113.13A8,8,0,0,1,159.82,102L227.48,55.7a8,8,0,0,1,9,13.21l-67.67,46.3a7.92,7.92,0,0,1-4.51,1.4A8,8,0,0,1,157.73,113.13Zm80.87,85.09a8,8,0,0,1-11.12,2.08L136,137.7,93.49,166.78a36,36,0,1,1-9-13.19L121.83,128,84.44,102.41a35.86,35.86,0,1,1,9-13.19l143,97.87A8,8,0,0,1,238.6,198.22ZM80,180a20,20,0,1,0-5.86,14.14A19.85,19.85,0,0,0,80,180ZM74.14,90.13a20,20,0,1,0-28.28,0A19.85,19.85,0,0,0,74.14,90.13Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Services</p>
                  </a>
                  <a href="reviews.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="Users" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Barbers</p> <!-- Changed "Staff" to "Barbers" -->
                  </a>
                  <!-- Availability link removed -->
                  <!-- Login/Logout Link -->
                  <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="php/auth/logout.php" class="flex items-center gap-3 px-3 py-2">
                      <div class="text-white" data-icon="SignOut" data-size="24px" data-weight="regular">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                          <path d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H56V208h48A8,8,0,0,1,112,216Zm109.66-92.69-48-48a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-34.35,34.35a8,8,0,0,0,11.32,11.32l48-48A8,8,0,0,0,221.66,123.31Z"></path>
                        </svg>
                      </div>
                      <p class="text-white text-sm font-medium leading-normal">Logout</p>
                    </a>
                  <?php else: ?>
                    <a href="login.php" class="flex items-center gap-3 px-3 py-2">
                      <div class="text-white" data-icon="SignIn" data-size="24px" data-weight="regular">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                          <path d="M104,216H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H56V208h48a8,8,0,0,1,0,16Zm117.66-92.69-48-48a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-34.35,34.35a8,8,0,0,0,11.32,11.32l48-48A8,8,0,0,0,221.66,123.31Z"></path>
                        </svg>
                      </div>
                      <p class="text-white text-sm font-medium leading-normal">Log In</p>
                    </a>
                  <?php endif; ?>
                  <!-- End Login/Logout Link -->
                </div>
              </div>
            </div>
          </div>
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Dashboard</p>
            </div>

            <!-- Welcome Message -->
            <div class="p-4">
              <h1 class="text-white text-xl font-semibold">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
            </div>

            <?php
            // Fetch statistics
            $total_appointments_completed = 0;
            $total_revenue = 0.00;
            $average_rating = "N/A";
            $stats_error = null;

            // Temp connection for stats - this will be separate from the appointments list connection later in the file
            $stats_conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if ($stats_conn->connect_error) {
                error_log("Dashboard Stats - DB Connection failed: " . $stats_conn->connect_error);
                $stats_error = "Could not load statistics due to a server issue.";
            } else {
                // Total Completed/Confirmed Appointments
                $result_total_app = $stats_conn->query("SELECT COUNT(*) AS total_appointments FROM appointments WHERE status = 'completed' OR status = 'confirmed'");
                if ($result_total_app) {
                    $total_appointments_completed = $result_total_app->fetch_assoc()['total_appointments'] ?? 0;
                } else {
                    error_log("Dashboard Stats - Failed to fetch total appointments: " . $stats_conn->error);
                    $stats_error = "Could not load total appointments.";
                }

                // Total Revenue
                $result_revenue = $stats_conn->query("SELECT SUM(s.price) AS total_revenue FROM appointments a JOIN services s ON a.service_id = s.id WHERE a.status = 'completed' OR a.status = 'confirmed'");
                if ($result_revenue) {
                    $total_revenue = $result_revenue->fetch_assoc()['total_revenue'] ?? 0.00;
                } else {
                    error_log("Dashboard Stats - Failed to fetch total revenue: " . $stats_conn->error);
                    if(!$stats_error) $stats_error = "Could not load total revenue."; else $stats_error .= " Could not load total revenue.";
                }

                // Average Rating
                $result_avg_rating = $stats_conn->query("SELECT AVG(rating) AS average_rating FROM reviews");
                if ($result_avg_rating) {
                    $avg_rating_val = $result_avg_rating->fetch_assoc()['average_rating'];
                    if ($avg_rating_val !== null) {
                        $average_rating = number_format((float)$avg_rating_val, 1);
                    }
                } else {
                    error_log("Dashboard Stats - Failed to fetch average rating: " . $stats_conn->error);
                     if(!$stats_error) $stats_error = "Could not load average rating."; else $stats_error .= " Could not load average rating.";
                }
                $stats_conn->close();
            }
            ?>
            <div class="flex flex-wrap gap-4 p-4">
              <?php if ($stats_error): ?>
                <div class="col-span-full text-red-500 p-4"><?php echo htmlspecialchars($stats_error); ?></div>
              <?php endif; ?>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#634136]">
                <p class="text-white text-base font-medium leading-normal">Total Completed Appointments</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo htmlspecialchars($total_appointments_completed); ?></p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#634136]">
                <p class="text-white text-base font-medium leading-normal">Total Revenue</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight">$<?php echo htmlspecialchars(number_format((float)$total_revenue, 2)); ?></p>
              </div>
              <div class="flex min-w-[158px] flex-1 flex-col gap-2 rounded-xl p-6 border border-[#634136]">
                <p class="text-white text-base font-medium leading-normal">Average Rating</p>
                <p class="text-white tracking-light text-2xl font-bold leading-tight"><?php echo htmlspecialchars($average_rating); ?></p>
              </div>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Your Upcoming Appointments</h2>
            <div class="px-4 py-3 @container">
              <?php
              require_once 'php/config.php'; // Path relative to root

              // Check if DB constants are defined
              if (!defined('DB_HOST') || !defined('DB_USERNAME') || !defined('DB_PASSWORD') || !defined('DB_NAME')) {
                  // For HTML pages, you might want to display a more user-friendly error message.
                  // You could redirect to an error page or display a message directly.
                  die("<div class='p-4 text-red-500'>Database configuration is missing. Please contact the site administrator or set up your php/config.php file.</div>");
              }

              // Establish Database Connection
              $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
              $db_error_occurred = false;

              if ($conn->connect_error) {
                  error_log("Dashboard - DB Connection failed: " . $conn->connect_error);
                  echo "<p class='text-red-500'>Could not load appointments due to a server issue. Please try again later.</p>";
                  $db_error_occurred = true;
              } else {
                  $user_id = $_SESSION['user_id'];
                  $sql = "SELECT
                              a.id AS appointment_id,
                              a.appointment_datetime,
                              b.name AS barber_name,
                              s.name AS service_name,
                              s.duration_minutes,
                              a.status
                          FROM
                              appointments a
                          JOIN
                              barbers b ON a.barber_id = b.id
                          JOIN
                              services s ON a.service_id = s.id
                          WHERE
                              a.user_id = ? AND
                              (a.status = 'scheduled' OR a.status = 'confirmed') AND
                              a.appointment_datetime >= NOW()
                          ORDER BY
                              a.appointment_datetime ASC";

                  $stmt = $conn->prepare($sql);

                  if ($stmt) {
                      $stmt->bind_param("i", $user_id);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      $appointments = $result->fetch_all(MYSQLI_ASSOC);
                      $stmt->close();

                      if (count($appointments) > 0) {
                          echo "<div class='overflow-x-auto rounded-xl border border-[#634136]'>";
                          echo "<table class='min-w-full text-white'>";
                          echo "<thead class='bg-[#31211b]'><tr class='text-left'>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Date & Time</th>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Barber</th>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Service</th>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Duration</th>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Status</th>";
                          echo "<th class='px-4 py-3 text-sm font-medium'>Action</th>";
                          echo "</tr></thead><tbody class='bg-[#211612] divide-y divide-[#452e26]'>";

                          foreach ($appointments as $app) {
                              echo "<tr>";
                              echo "<td class='px-4 py-3'>" . htmlspecialchars(date("F j, Y, g:i a", strtotime($app['appointment_datetime']))) . "</td>";
                              echo "<td class='px-4 py-3'>" . htmlspecialchars($app['barber_name']) . "</td>";
                              echo "<td class='px-4 py-3'>" . htmlspecialchars($app['service_name']) . "</td>";
                              echo "<td class='px-4 py-3'>" . htmlspecialchars($app['duration_minutes']) . " min</td>";
                              echo "<td class='px-4 py-3'>" . htmlspecialchars(ucfirst($app['status'])) . "</td>";
                              echo "<td class='px-4 py-3'><button class='cancel-appointment-btn text-red-500 hover:text-red-700 text-xs' data-appointment-id='" . htmlspecialchars($app['appointment_id']) . "'>Cancel</button></td>";
                              echo "</tr>";
                          }
                          echo "</tbody></table></div>";
                      } else {
                          echo "<div id='upcomingAppointmentsContent' class='text-white p-4 border border-[#634136] rounded-xl'>"; // This div can also be used for messages
                          echo "<p>You have no upcoming appointments.</p>";
                          echo "</div>";
                      }
                  } else {
                      error_log("Dashboard - DB prepare statement failed: " . $conn->error);
                      echo "<p class='text-red-500'>Could not load appointments due to a server issue. Please try again later.</p>";
                      $db_error_occurred = true; // To prevent further DB operations if conn was initially ok
                  }
                  if (!$db_error_occurred) { // Only close if $conn was successfully established
                    $conn->close();
                  }
              }
              ?>
            </div>
            <div id="cancelAppointmentMessage" class="px-4 py-2 text-center"></div> <!-- Div for cancellation messages -->

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cancelButtons = document.querySelectorAll('.cancel-appointment-btn');
                const cancelMessageDiv = document.getElementById('cancelAppointmentMessage');

                cancelButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const appointmentId = this.dataset.appointmentId;

                        if (!confirm('Are you sure you want to cancel this appointment?')) {
                            return;
                        }

                        cancelMessageDiv.textContent = 'Processing...';
                        cancelMessageDiv.className = 'px-4 py-2 text-center text-gray-300'; // Neutral color

                        const formData = new FormData();
                        formData.append('appointment_id', appointmentId);

                        fetch('php/api/cancel_appointment.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                cancelMessageDiv.textContent = data.message;
                                cancelMessageDiv.className = 'px-4 py-2 text-center text-green-500';
                                // Visually update the row:
                                // Option 1: Remove the row
                                // this.closest('tr').remove();
                                // Option 2: Change status text and disable button
                                const row = this.closest('tr');
                                if (row) {
                                    const statusCell = row.cells[4]; // Assuming status is the 5th cell
                                    if (statusCell) {
                                        statusCell.textContent = 'Cancelled';
                                    }
                                    this.textContent = 'Cancelled';
                                    this.disabled = true;
                                    this.classList.remove('text-red-500', 'hover:text-red-700');
                                    this.classList.add('text-gray-400', 'cursor-not-allowed');
                                }
                                // If all appointments are cancelled, update the main content message
                                const appointmentsTable = document.querySelector('.min-w-full');
                                if (appointmentsTable && appointmentsTable.tBodies[0] && appointmentsTable.tBodies[0].rows.length > 0) {
                                    let allCancelled = true;
                                    for (let r of appointmentsTable.tBodies[0].rows) {
                                        if (r.cells[4] && r.cells[4].textContent.toLowerCase() !== 'cancelled') {
                                            allCancelled = false;
                                            break;
                                        }
                                    }
                                    if (allCancelled) {
                                        const upcomingContentDiv = document.getElementById('upcomingAppointmentsContent');
                                        if (upcomingContentDiv) {
                                            upcomingContentDiv.innerHTML = "<p>You have no upcoming appointments.</p>";
                                        }
                                         // Hide the table if it exists and all are cancelled
                                        if(appointmentsTable.parentElement.classList.contains('overflow-x-auto')) {
                                            appointmentsTable.parentElement.style.display = 'none';
                                        }
                                    }
                                }


                            } else {
                                cancelMessageDiv.textContent = data.error || 'Failed to cancel appointment.';
                                cancelMessageDiv.className = 'px-4 py-2 text-center text-red-500';
                            }
                        })
                        .catch(error => {
                            console.error('Cancellation error:', error);
                            cancelMessageDiv.textContent = 'An error occurred. Please try again.';
                            cancelMessageDiv.className = 'px-4 py-2 text-center text-red-500';
                        });
                    });
                });
            });
            </script>
            <!-- Original table structure for upcoming appointments can be dynamically populated or removed if not used directly -->
            <!-- For now, I'll comment out the static table to avoid confusion with the placeholder -->
              <!--
              <div class="flex overflow-hidden rounded-xl border border-[#634136] bg-[#211612]">
                <table class="flex-1">
                  <thead>
                    <tr class="bg-[#31211b]">
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">Customer</th>
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">Service</th>
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">Staff</th>
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">Date</th>
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 px-4 py-3 text-left text-white w-[400px] text-sm font-medium leading-normal">Time</th>
                      <th class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 px-4 py-3 text-left text-white w-60 text-sm font-medium leading-normal">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="border-t border-t-[#634136]">
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">Ethan Carter</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Haircut</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Alex</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        2024-07-20
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">10:00 AM</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#452e26] text-white text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Scheduled</span>
                        </button>
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#634136]">
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">
                        Olivia Bennett
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        Beard Trim
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Ryan</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        2024-07-20
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">11:00 AM</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#452e26] text-white text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Scheduled</span>
                        </button>
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#634136]">
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">Noah Davis</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        Haircut &amp; Style
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Alex</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        2024-07-20
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">12:00 PM</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#452e26] text-white text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Scheduled</span>
                        </button>
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#634136]">
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">Sophia Evans</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Coloring</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Ryan</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        2024-07-20
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">01:00 PM</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#452e26] text-white text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Scheduled</span>
                        </button>
                      </td>
                    </tr>
                    <tr class="border-t border-t-[#634136]">
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120 h-[72px] px-4 py-2 w-[400px] text-white text-sm font-normal leading-normal">Liam Foster</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Haircut</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">Alex</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">
                        2024-07-20
                      </td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600 h-[72px] px-4 py-2 w-[400px] text-[#c5a296] text-sm font-normal leading-normal">02:00 PM</td>
                      <td class="table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720 h-[72px] px-4 py-2 w-60 text-sm font-normal leading-normal">
                        <button
                          class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#452e26] text-white text-sm font-medium leading-normal w-full"
                        >
                          <span class="truncate">Scheduled</span>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <style>
                          /* @container(max-width:120px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-120{display: none;}} */
                /* @container(max-width:240px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-240{display: none;}} */
                /* @container(max-width:360px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-360{display: none;}} */
                /* @container(max-width:480px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-480{display: none;}} */
                /* @container(max-width:600px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-600{display: none;}} */
                /* @container(max-width:720px){.table-62d658d2-8424-4a5e-bab4-e47b4fc60a96-column-720{display: none;}} */
              </style>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Recent Reviews</h2>
            <div class="flex flex-col gap-4 overflow-x-hidden bg-[#211612] p-4">
                <?php
                $reviews_api_url = 'php/api/get_reviews.php';
                $reviews_error_message = null;
                $recent_reviews = [];

                if (file_exists($reviews_api_url)) {
                    $reviews_json = @file_get_contents($reviews_api_url);
                    if ($reviews_json === false) {
                        $reviews_error_message = "Error: Could not fetch recent reviews.";
                        error_log("Dashboard - file_get_contents failed for get_reviews.php");
                    } else {
                        $all_reviews = json_decode($reviews_json, true);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            $reviews_error_message = "Error: Could not process reviews data.";
                            error_log("Dashboard - JSON Decode Error for reviews: " . json_last_error_msg());
                        } elseif (isset($all_reviews['error'])) {
                            $reviews_error_message = "Error from reviews API: " . htmlspecialchars($all_reviews['error']);
                        } elseif (empty($all_reviews)) {
                            $reviews_error_message = "No recent reviews available.";
                        } else {
                            $recent_reviews = array_slice($all_reviews, 0, 2); // Get first 2 reviews
                        }
                    }
                } else {
                    $reviews_error_message = "Error: Reviews API endpoint not found.";
                    error_log("Dashboard - get_reviews.php not found at " . $reviews_api_url);
                }

                if (!empty($recent_reviews)) {
                    foreach ($recent_reviews as $review) {
                        $user_avatar_text = strtoupper(substr(htmlspecialchars($review['user_name'] ?? 'A'), 0, 1));
                        $review_date_formatted = htmlspecialchars(date("F j, Y", strtotime($review['review_date'])));
                        $rating = (int)$review['rating'];
                ?>
                        <div class="flex flex-col gap-3 bg-[#211612] p-3 border-b border-b-[#452e26]">
                            <div class="flex items-center gap-3">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                     style='background-image: url("https://via.placeholder.com/40/DB5224/FFFFFF?text=<?php echo $user_avatar_text; ?>");'></div>
                                <div class="flex-1">
                                    <p class="text-white text-base font-medium leading-normal"><?php echo htmlspecialchars($review['user_name'] ?? 'Anonymous'); ?></p>
                                    <p class="text-[#c5a296] text-sm font-normal leading-normal"><?php echo $review_date_formatted; ?></p>
                                    <?php if (!empty($review['barber_name'])): ?>
                                        <p class='text-[#c5a296] text-xs'>For: <?php echo htmlspecialchars($review['barber_name']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="flex gap-0.5">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <div class="text-<?php echo ($i < $rating) ? '[#db5224]' : '[#87594a]'; ?>" data-icon="Star" data-size="20px" data-weight="<?php echo ($i < $rating) ? 'fill' : 'regular'; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                            <?php if ($i < $rating): ?>
                                                <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                            <?php else: ?>
                                                <path d="M239.2,97.29a16,16,0,0,0-13.81-11L166,81.17,142.72,25.81h0a15.95,15.95,0,0,0-29.44,0L90.07,81.17,30.61,86.32a16,16,0,0,0-9.11,28.06L66.61,153.8,53.09,212.34a16,16,0,0,0,23.84,17.34l51-31,51.11,31a16,16,0,0,0,23.84-17.34l-13.51-58.6,45.1-39.36A16,16,0,0,0,239.2,97.29Zm-15.22,5-45.1,39.36a16,16,0,0,0-5.08,15.71L187.35,216v0l-51.07-31a15.9,15.9,0,0,0-16.54,0l-51,31h0L82.2,157.4a16,16,0,0,0-5.08-15.71L32,102.35a.37.37,0,0,1,0-.09l59.44-5.14a16,16,0,0,0,13.35-9.75L128,32.08l23.2,55.29a16,16,0,0,0,13.35,9.75L224,102.26S224,102.32,224,102.33Z"></path>
                                            <?php endif; ?>
                                        </svg>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <p class="text-white text-base font-normal leading-normal"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                        </div>
                <?php
                    } // end foreach
                } else {
                    echo "<p class='text-white px-4 py-3'>" . ($reviews_error_message ?: "No recent reviews.") . "</p>";
                }
                ?>
            </div>
          </div>
        </div>
        <footer class="flex justify-center">
          <div class="flex max-w-[960px] flex-1 flex-col">
            <footer class="flex flex-col gap-6 px-5 py-10 text-center @container">
              <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40" href="#">Contact Us</a>
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40" href="#">Privacy Policy</a>
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40" href="#">Terms of Service</a>
              </div>
              <div class="flex flex-wrap justify-center gap-4">
                <a href="#">
                  <div class="text-[#c5a296]" data-icon="TwitterLogo" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path
                        d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z"
                      ></path>
                    </svg>
                  </div>
                </a>
                <a href="#">
                  <div class="text-[#c5a296]" data-icon="InstagramLogo" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path
                        d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160ZM176,24H80A56.06,56.06,0,0,0,24,80v96a56.06,56.06,0,0,0,56,56h96a56.06,56.06,0,0,0,56-56V80A56.06,56.06,0,0,0,176,24Zm40,152a40,40,0,0,1-40,40H80a40,40,0,0,1-40-40V80A40,40,0,0,1,80,40h96a40,40,0,0,1,40,40ZM192,76a12,12,0,1,1-12-12A12,12,0,0,1,192,76Z"
                      ></path>
                    </svg>
                  </div>
                </a>
                <a href="#">
                  <div class="text-[#c5a296]" data-icon="FacebookLogo" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path
                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"
                      ></path>
                    </svg>
                  </div>
                </a>
              </div>
              <p class="text-[#c5a296] text-base font-normal leading-normal">© 2024 Barber Shop. All rights reserved.</p>
            </footer>
          </div>
        </footer>
      </div>
    </div>
  </body>
</html>
