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
    <?php session_start(); ?>
    <div
      class="relative flex size-full min-h-screen flex-col bg-[#211612] dark group/design-root overflow-x-hidden"
      style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'
    >
      <div class="layout-container flex h-full grow flex-col">
        <div class="gap-1 px-6 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-80">
            <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#211612] p-4">
              <div class="flex flex-col gap-4">
                <div class="flex gap-3">
                  <div
                    class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDgG6B1EE5ISHP4ew5-9F1hOIuHM2L9WmFg2pj0ayy6ta3G9MiDLsxt_gRlXEhOYO6xAmNzQAfpkrMrRWrdvqeAIMq9GFsBClsmCUaRYgJsBQa5dHHxDtAmQYcVycbZF5fSKU7nt_Q7IeeFh7kNUhiMXP0JJUbaPeGZUKv6H9PTObL5_tLJkdtVdiH_zWpFyOVJkkFcg8zsjTpixo_9YK7dzD8fC19KErjiFvi5HDHAEGUsoGpCv3vnVwnHTjHtcB2sPXRtOj1zlg");'
                  ></div>
                  <h1 class="text-white text-base font-medium leading-normal">Sophia</h1>
                </div>
                <div class="flex flex-col gap-2">
                  <a href="home.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="House" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M218.83,103.77l-80-75.48a1.14,1.14,0,0,1-.11-.11,16,16,0,0,0-21.53,0l-.11.11L37.17,103.77A16,16,0,0,0,32,115.55V208a16,16,0,0,0,16,16H96a16,16,0,0,0,16-16V160h32v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V115.55A16,16,0,0,0,218.83,103.77ZM208,208H160V160a16,16,0,0,0-16-16H112a16,16,0,0,0-16,16v48H48V115.55l.11-.1L128,40l79.9,75.43.11.1Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Home</p>
                  </a>
                  <a href="servizi.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="Scissors" data-size="24px" data-weight="regular"> <!-- Changed icon to Scissors for Services -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                         <path d="M157.73,113.13A8,8,0,0,1,159.82,102L227.48,55.7a8,8,0,0,1,9,13.21l-67.67,46.3a7.92,7.92,0,0,1-4.51,1.4A8,8,0,0,1,157.73,113.13Zm80.87,85.09a8,8,0,0,1-11.12,2.08L136,137.7,93.49,166.78a36,36,0,1,1-9-13.19L121.83,128,84.44,102.41a35.86,35.86,0,1,1,9-13.19l143,97.87A8,8,0,0,1,238.6,198.22ZM80,180a20,20,0,1,0-5.86,14.14A19.85,19.85,0,0,0,80,180ZM74.14,90.13a20,20,0,1,0-28.28,0A19.85,19.85,0,0,0,74.14,90.13Z"></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Services</p> <!-- Was Explore -->
                  </a>
                  <a href="bookappointment.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]">
                    <div class="text-white" data-icon="Plus" data-size="24px" data-weight="regular">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Book Appointment</p> <!-- Was Book -->
                  </a>
                  <a href="appointments.php" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-[#452e26]"> <!-- Made this active -->
                    <div class="text-white" data-icon="Calendar" data-size="24px" data-weight="fill"> <!-- Icon for Appointments -->
                       <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path></svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">My Appointments</p>
                  </a>
                  <a href="dashboard.php" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-[#452e26]"> <!-- Was Profile -->
                    <div class="text-white" data-icon="UserCircle" data-size="24px" data-weight="regular"> <!-- Regular weight for non-active -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                        <path
                          d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM40,128a88.1,88.1,0,0,1,88-88V72.85a59.4,59.4,0,0,0-47.91,47.24A88.06,88.06,0,0,1,40,128Zm88,88V183.15a59.4,59.4,0,0,0,47.91-47.24A88.06,88.06,0,0,1,216,128a88.1,88.1,0,0,1-88,88Zm0-104a28,28,0,1,1,28-28A28,28,0,0,1,128,112Zm83.14,42.23a103.87,103.87,0,0,0-21.4-22.17A44.06,44.06,0,0,0,172,120a44,44,0,1,0-44,44,44.06,44.06,0,0,0,12.34-2.26,103.87,103.87,0,0,0,22.17-21.4A87.8,87.8,0,0,1,192.26,168,88.05,88.05,0,0,1,176,183.15V216a87.83,87.83,0,0,1-25.77-3.72A104.34,104.34,0,0,0,172,192.26a103.53,103.53,0,0,0,39.14-37.93Z"
                        ></path>
                      </svg>
                    </div>
                    <p class="text-white text-sm font-medium leading-normal">Dashboard</p> <!-- Was Profile -->
                  </a>
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
              <!-- Invite friends removed -->
            </div>
          </div>
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4"><p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Appointments</p></div>
            <div class="pb-3">
              <div class="flex border-b border-[#634136] px-4 gap-8">
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-[#db5224] text-white pb-[13px] pt-4" href="#">
                  <p class="text-white text-sm font-bold leading-normal tracking-[0.015em]">Upcoming</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-[#c5a296] pb-[13px] pt-4" href="#">
                  <p class="text-[#c5a296] text-sm font-bold leading-normal tracking-[0.015em]">Past</p>
                </a>
              </div>
            </div>
            <div class="flex flex-col px-4 py-6">
              <div class="flex flex-col items-center gap-6">
                <div
                  class="bg-center bg-no-repeat aspect-video bg-cover rounded-xl w-full max-w-[360px]"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCHx9DLVfJx4LE5rfTkijqIEwHHWc3tLgQ2BDYn09Vmssd0zgX0LLWz5Ra7mojyth5_aFF3se5R8MOMck6AQ_IvEFOUqUTKPxas7miR4KoDc_GkotgQq8WmEGLehAC3C-ZZlRKRp2917FAFqjtWQxs5BF1mRqZfVBKXVUDhQo6EVCDUrD7KH9AEiMdBmIWeOcnvzmHQZbHU4iZjmCUQ2ihqAD-QU4syqA3KX0b7GXR_nUrrRn_BkPK5m4a90G4pKX7pg4m6j18OhQ");'
                ></div>
                <div class="flex max-w-[480px] flex-col items-center gap-2">
                  <p class="text-white text-lg font-bold leading-tight tracking-[-0.015em] max-w-[480px] text-center">No upcoming appointments</p>
                  <p class="text-white text-sm font-normal leading-normal max-w-[480px] text-center">You don't have any upcoming appointments. Book one now to get started.</p>
                </div>
                <a href="bookappointment.php"
                  class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#452e26] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-80"
                >
                  <span class="truncate">Book now</span>
                </a>
              </div>
            </div>
            <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Past appointments</h2>
            <div class="flex flex-col px-4 py-6">
              <div class="flex flex-col items-center gap-6">
                <div
                  class="bg-center bg-no-repeat aspect-video bg-cover rounded-xl w-full max-w-[360px]"
                  style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBZnrzKAdMkFE6KFRzho8oqstFoh_P56ojkXkh8Nx_9-6MSmZo-K_8akHbOqGJ0kMihnLOEXfur-EyYzE6LZC2Rj4r2nhue0WTJnkAGs7CDiOCTV6PVq3qkFUBi4qn1Tnm4tzH5Ay13hqkx9mMKCXLmGyQ_OvW0a3jhgKRSBD_nlbuVxRaAo-aL7fl0HGSyk2my_6amKPN48eN5b6_JJkzl6vFWWWcCBSMs176zIGG10Zxa9KnCKL_B35Wc9FziFBbhs9Vid3MaFA");'
                ></div>
                <div class="flex max-w-[480px] flex-col items-center gap-2">
                  <p class="text-white text-lg font-bold leading-tight tracking-[-0.015em] max-w-[480px] text-center">No past appointments</p>
                  <p class="text-white text-sm font-normal leading-normal max-w-[480px] text-center">
                    You don't have any past appointments. Once you've completed an appointment, it will show up here.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="flex justify-center">
          <div class="flex max-w-[960px] flex-1 flex-col">
            <footer class="flex flex-col gap-6 px-5 py-10 text-center @container">
              <div class="flex flex-wrap items-center justify-center gap-6 @[480px]:flex-row @[480px]:justify-around">
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 hover:text-orange-500" href="#">Contact Us</a>
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 hover:text-orange-500" href="#">Privacy Policy</a>
                <a class="text-[#c5a296] text-base font-normal leading-normal min-w-40 hover:text-orange-500" href="#">Terms of Service</a>
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
                  <div class="text-[#c5a296]" data-icon="FacebookLogo" data-size="24px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path
                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm8,191.63V152h24a8,8,0,0,0,0-16H136V112a16,16,0,0,1,16-16h16a8,8,0,0,0,0-16H152a32,32,0,0,0-32,32v24H96a8,8,0,0,0,0,16h24v63.63a88,88,0,1,1,16,0Z"
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
              </div>
              <p class="text-[#c5a296] text-base font-normal leading-normal">© 2024 The Sharp Edge Barbershop. All rights reserved.</p>
            </footer>
          </div>
        </footer>
      </div>
    </div>
  </body>
</html>
