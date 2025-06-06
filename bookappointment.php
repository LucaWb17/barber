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
    <?php
        session_start();
        // Define variables for pre-filling customer details if logged in
        $customer_name_value = '';
        $customer_email_value = '';
        if (isset($_SESSION['user_id'])) { // Check if user is logged in
            if (isset($_SESSION['user_name'])) {
                $customer_name_value = htmlspecialchars($_SESSION['user_name']);
            }
            if (isset($_SESSION['user_email'])) {
                $customer_email_value = htmlspecialchars($_SESSION['user_email']);
            }
        }
    ?>
    <div
      class="relative flex size-full min-h-screen flex-col bg-[#211612] dark group/design-root overflow-x-hidden"
      style='--select-button-svg: url(&apos;data:image/svg+xml,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%2724px%27 height=%2724px%27 fill=%27rgb(197,162,150)%27 viewBox=%270 0 256 256%27%3e%3cpath d=%27M181.66,170.34a8,8,0,0,1,0,11.32l-48,48a8,8,0,0,1-11.32,0l-48-48a8,8,0,0,1,11.32-11.32L128,212.69l42.34-42.35A8,8,0,0,1,181.66,170.34Zm-96-84.68L128,43.31l42.34,42.35a8,8,0,0,0,11.32-11.32l-48-48a8,8,0,0,0-11.32,0l-48,48A8,8,0,0,0,85.66,85.66Z%27%3e%3c/path%3e%3c/svg%3e&apos;); font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'
    >
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#452e26] px-10 py-3">
          <div class="flex items-center gap-4 text-white">
            <div class="size-4">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_6_543)">
                  <path
                    d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z"
                    fill="currentColor"
                  ></path>
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z"
                    fill="currentColor"
                  ></path>
                </g>
                <defs>
                  <clipPath id="clip0_6_543"><rect width="48" height="48" fill="white"></rect></clipPath>
                </defs>
              </svg>
            </div>
            <h2 class="text-white text-lg font-bold leading-tight tracking-[-0.015em]">Clipper</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="servizi.php">Services</a>
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="reviews.php">Barbers</a>
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="locations.php">Locations</a> <!-- Updated Locations link -->
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="contact.php">Contact</a> <!-- Updated Contact link -->
            </div>
            <div class="flex items-center gap-4">
               <a href="home.php"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#db5224] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-orange-600"
              >
                <span class="truncate">Home</span>
              </a>
              <?php if (isset($_SESSION['user_id'])): ?>
                <a href="php/auth/logout.php" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#452e26] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-80">
                  <span class="truncate">Logout</span>
                </a>
              <?php else: ?>
                <a href="login.php" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#452e26] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-80">
                  <span class="truncate">Log In</span>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <form id="bookingForm" action="php/api/book_appointment.php" method="POST" class="layout-content-container flex flex-col w-[512px] max-w-[512px] py-5 max-w-[960px] flex-1">
            <h2 class="text-white tracking-light text-[28px] font-bold leading-tight px-4 text-center pb-3 pt-5">Book an appointment</h2>
            <div id="bookingMessages" class="mt-2 mb-4 px-4 text-center"></div> <!-- Added booking messages div -->
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <select
                  id="barberSelect"
                  name="barber_id"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 bg-[image:--select-button-svg] placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  required
                >
                  <option value="">Select a barber</option>
                  <!-- Barbers will be populated here by JavaScript -->
                </select>
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <select
                  id="serviceSelect"
                  name="service_id"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 bg-[image:--select-button-svg] placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  required
                >
                  <option value="">Select a service</option>
                  <!-- Services will be populated here by JavaScript -->
                </select>
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-white text-sm font-medium leading-normal pb-1">Select Date:</p>
                <input
                  type="date"
                  id="appointment_date"
                  name="appointment_date"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  required
                />
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <p class="text-white text-sm font-medium leading-normal pb-1">Select Time:</p>
                <select
                  id="appointment_time"
                  name="appointment_time"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 bg-[image:--select-button-svg] placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  required
                >
                  <option value="">Select barber and date first</option>
                </select>
              </label>
            </div>
            <input type="hidden" name="appointment_datetime" id="appointment_datetime_combined">
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <input
                  type="text"
                  name="customer_name"
                  placeholder="Your name"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  value="<?php echo $customer_name_value; ?>"
                  required
                />
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <input
                  type="email"
                  name="customer_email"
                  placeholder="Your email"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  value="<?php echo $customer_email_value; ?>"
                  required
                />
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <input
                  type="tel"
                  name="customer_phone"
                  placeholder="Your phone number"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border border-[#634136] bg-[#31211b] focus:border-[#634136] h-14 placeholder:text-[#c5a296] p-[15px] text-base font-normal leading-normal"
                  required
                />
              </label>
            </div>
            <div class="flex px-4 py-3">
              <button
                type="submit"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 flex-1 bg-[#db5224] text-white text-sm font-bold leading-normal tracking-[0.015em]"
              >
                <span class="truncate">Book appointment</span>
              </button>
            </div>
            <p class="text-[#c5a296] text-sm font-normal leading-normal pb-3 pt-1 px-4 text-center underline">Already have an account? <a href="login.php" class="underline">Log in</a></p>
          </form>
        </div>
        <footer class="flex justify-center">
          <div class="flex max-w-[960px] flex-1 flex-col">
            <footer class="flex flex-col gap-6 px-5 py-10 text-center @container">
              <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 opacity-50 cursor-default">Privacy Policy</a> <!-- Disabled Privacy Policy -->
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 opacity-50 cursor-default">Terms of Service</a> <!-- Disabled Terms of Service -->
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 hover:text-orange-500" href="contact.php">Contact Us</a> <!-- Updated Contact Us link -->
              </div>
              <div class="flex flex-wrap justify-center gap-4">
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
                  <div class="text-[#c5a296]" data-icon="TwitterLogo" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path
                        d="M247.39,68.94A8,8,0,0,0,240,64H209.57A48.66,48.66,0,0,0,168.1,40a46.91,46.91,0,0,0-33.75,13.7A47.9,47.9,0,0,0,120,88v6.09C79.74,83.47,46.81,50.72,46.46,50.37a8,8,0,0,0-13.65,4.92c-4.31,47.79,9.57,79.77,22,98.18a110.93,110.93,0,0,0,21.88,24.2c-15.23,17.53-39.21,26.74-39.47,26.84a8,8,0,0,0-3.85,11.93c.75,1.12,3.75,5.05,11.08,8.72C53.51,229.7,65.48,232,80,232c70.67,0,129.72-54.42,135.75-124.44l29.91-29.9A8,8,0,0,0,247.39,68.94Zm-45,29.41a8,8,0,0,0-2.32,5.14C196,166.58,143.28,216,80,216c-10.56,0-18-1.4-23.22-3.08,11.51-6.25,27.56-17,37.88-32.48A8,8,0,0,0,92,169.08c-.47-.27-43.91-26.34-44-96,16,13,45.25,33.17,78.67,38.79A8,8,0,0,0,136,104V88a32,32,0,0,1,9.6-22.92A30.94,30.94,0,0,1,167.9,56c12.66.16,24.49,7.88,29.44,19.21A8,8,0,0,0,204.67,80h16Z"
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
              <p class="text-[#c5a296] text-base font-normal leading-normal">© 2024 Clipper. All rights reserved.</p>
            </footer>
          </div>
        </footer>
      </div>
    </div>
  </body>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const barberSelect = document.getElementById('barberSelect');
        const serviceSelect = document.getElementById('serviceSelect');
        const appointmentDateInput = document.getElementById('appointment_date');
        const appointmentTimeSelect = document.getElementById('appointment_time');
        const bookingForm = document.getElementById('bookingForm');
        const bookingMessagesDiv = document.getElementById('bookingMessages');
        const combinedDateTimeInput = document.getElementById('appointment_datetime_combined');

        function displayMessage(html, type) {
            bookingMessagesDiv.innerHTML = html;
            bookingMessagesDiv.className = `mt-2 mb-4 px-4 text-center ${type === 'success' ? 'text-green-500' : (type === 'error' ? 'text-red-500' : 'text-gray-300')}`;
        }

        function fetchAvailability() {
            const barberId = barberSelect.value;
            const selectedDate = appointmentDateInput.value;
            const serviceId = serviceSelect.value; // Get selected service ID
            const selectedServiceOption = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceDuration = (selectedServiceOption && selectedServiceOption.value !== "") ? selectedServiceOption.dataset.duration : null;

            appointmentTimeSelect.innerHTML = '<option value="">Loading times...</option>';
            appointmentTimeSelect.disabled = true;

            if (!barberId || !selectedDate || !serviceId || !serviceDuration) { // Updated condition
                appointmentTimeSelect.innerHTML = '<option value="">Select barber, date, and service</option>';
                // displayMessage('<p>Please select a barber, date, and service to see available times.</p>', 'neutral'); // Optional
                return;
            }

            const today = new Date();
            const inputDate = new Date(selectedDate + "T00:00:00");
            today.setHours(0,0,0,0);
            if (inputDate < today) {
                 appointmentTimeSelect.innerHTML = '<option value="">Cannot select past dates</option>';
                 displayMessage('<p>Please select a current or future date.</p>', 'error');
                 return;
            }

            // Updated fetch URL
            fetch(`php/api/get_availability.php?barber_id=${barberId}&date=${selectedDate}&service_duration_minutes=${serviceDuration}`)
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                    return response.json();
                })
                .then(data => {
                    appointmentTimeSelect.innerHTML = '<option value="">Select a time</option>';
                    if (data.error) {
                        console.error('API error fetching availability:', data.error);
                        displayMessage(`<p>${data.error}</p>`, 'error');
                        appointmentTimeSelect.innerHTML = `<option value="">${data.message || 'Error loading times'}</option>`;
                    } else if (data.available_slots && data.available_slots.length > 0) {
                        data.available_slots.forEach(slot => {
                            const option = document.createElement('option');
                            option.value = slot;
                            const timeParts = slot.split(':');
                            const dateForFormatting = new Date();
                            dateForFormatting.setHours(parseInt(timeParts[0]), parseInt(timeParts[1]), 0);
                            option.textContent = dateForFormatting.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
                            appointmentTimeSelect.appendChild(option);
                        });
                        appointmentTimeSelect.disabled = false;
                    } else {
                        appointmentTimeSelect.innerHTML = '<option value="">No slots available</option>';
                        if(data.message) displayMessage(`<p>${data.message}</p>`, 'neutral'); else displayMessage('<p>No slots available for this combination.</p>', 'neutral');
                    }
                })
                .catch(error => {
                    console.error('Network error fetching availability:', error);
                    displayMessage('<p>Network error fetching availability. Please try again.</p>', 'error');
                    appointmentTimeSelect.innerHTML = '<option value="">Error loading times</option>';
                });
        }

        barberSelect.addEventListener('change', fetchAvailability);
        appointmentDateInput.addEventListener('change', fetchAvailability);
        serviceSelect.addEventListener('change', fetchAvailability); // ADDED

        fetch('php/api/get_barbers.php')
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('API error fetching barbers:', data.error);
                    barberSelect.innerHTML = '<option value="">Error loading barbers</option>';
                    return;
                }
                if (Array.isArray(data)) {
                    data.forEach(barber => {
                        const option = document.createElement('option');
                        option.value = barber.id;
                        option.textContent = barber.name + (barber.specialty ? ` - ${barber.specialty}` : '');
                        barberSelect.appendChild(option);
                    });
                } else {
                     console.error('Unexpected data format for barbers:', data);
                     barberSelect.innerHTML = '<option value="">Format error barbers</option>';
                }
            })
            .catch(error => {
                console.error('Network error fetching barbers:', error);
                barberSelect.innerHTML = '<option value="">Network error barbers</option>';
            });

        fetch('php/api/get_services.php')
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('API error fetching services:', data.error);
                    serviceSelect.innerHTML = '<option value="">Error loading services</option>';
                    return;
                }
                if (Array.isArray(data)) {
                    data.forEach(service => {
                        const option = document.createElement('option');
                        option.value = service.id;
                        let price = parseFloat(service.price).toFixed(2);
                        option.textContent = `${service.name} (${service.duration_minutes} min) - $${price}`;
                        option.dataset.duration = service.duration_minutes; // STORE DURATION
                        serviceSelect.appendChild(option);
                    });
                } else {
                    console.error('Unexpected data format for services:', data);
                    serviceSelect.innerHTML = '<option value="">Format error services</option>';
                }
            })
            .catch(error => {
                console.error('Network error fetching services:', error);
                serviceSelect.innerHTML = '<option value="">Network error services</option>';
            });

        fetchAvailability();

        if (bookingForm) {
            bookingForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const selectedDate = appointmentDateInput.value;
                const selectedTime = appointmentTimeSelect.value;

                if (!selectedDate || !selectedTime || selectedTime === "") {
                    displayMessage('<p>Please select a valid date and time slot.</p>', 'error');
                    return;
                }
                const combinedDateTime = selectedDate + ' ' + selectedTime + ':00';
                combinedDateTimeInput.value = combinedDateTime;

                displayMessage('<p>Processing...</p>', 'neutral');
                const formData = new FormData(bookingForm);

                fetch('php/api/book_appointment.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayMessage(`<p>${data.message}</p>`, 'success');
                        bookingForm.reset();
                        barberSelect.value = "";
                        serviceSelect.value = "";
                        appointmentDateInput.value = "";
                        appointmentTimeSelect.innerHTML = '<option value="">Select barber, date, and service</option>';
                        appointmentTimeSelect.disabled = true;
                    } else if (data.errors) {
                        let errorHtml = '<ul>';
                        for (const field in data.errors) {
                            errorHtml += `<li>${data.errors[field]}</li>`;
                        }
                        errorHtml += '</ul>';
                        displayMessage(errorHtml, 'error');
                    } else if (data.error) {
                        displayMessage(`<p>${data.error}</p>`, 'error');
                    } else {
                        displayMessage('<p>An unknown error occurred.</p>', 'error');
                    }
                })
                .catch(error => {
                    console.error('Booking submission error:', error);
                    displayMessage('<p>Could not submit booking. Please check your connection and try again.</p>', 'error');
                });
            });
        }
    });
  </script>
</html>

[end of bookappointment.php]
