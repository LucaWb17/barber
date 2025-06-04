<?php
    session_start(); // Start session to access session variables
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
    <?php
    // Display session messages if they exist
    if (isset($_SESSION['message'])) {
        echo '<p style="color: green; text-align: center; margin-top: 10px;">' . htmlspecialchars($_SESSION['message']) . '</p>';
        unset($_SESSION['message']); // Clear the message after displaying
    }
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red; text-align: center; margin-top: 10px;">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']); // Clear the error after displaying
    }
    ?>
    <div
      class="relative flex size-full min-h-screen flex-col bg-[#211612] dark group/design-root overflow-x-hidden"
      style='--checkbox-tick-svg: url(&apos;data:image/svg+xml,%3csvg viewBox=%270 0 16 16%27 fill=%27rgb(255,255,255)%27 xmlns=%27http://www.w3.org/2000/svg%27%3e%3cpath d=%27M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z%27/%3e%3c/svg%3e&apos;); font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'
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
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="#">Locations</a>
              <a class="text-white text-sm font-medium leading-normal hover:text-orange-500" href="#">Contact</a>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
              <a href="php/auth/logout.php" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#452e26] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-80">
                <span class="truncate">Logout</span>
              </a>
            <?php else: ?>
              <a href="createanaccount.php" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 px-4 bg-[#db5224] text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-opacity-80">
                <span class="truncate">Sign Up</span>
              </a>
            <?php endif; ?>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <form action="php/auth/login.php" method="POST" class="layout-content-container flex flex-col w-[512px] max-w-[512px] py-5 max-w-[960px] flex-1">
            <h2 class="text-white tracking-light text-[28px] font-bold leading-tight px-4 text-center pb-3 pt-5">Log in to your account</h2>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <input
                  type="email"
                  name="email"
                  placeholder="Email"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border-none bg-[#452e26] focus:border-none h-14 placeholder:text-[#c5a296] p-4 text-base font-normal leading-normal"
                  value=""
                  required
                />
              </label>
            </div>
            <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
              <label class="flex flex-col min-w-40 flex-1">
                <input
                  type="password"
                  name="password"
                  placeholder="Password"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border-none bg-[#452e26] focus:border-none h-14 placeholder:text-[#c5a296] p-4 text-base font-normal leading-normal"
                  value=""
                  required
                />
              </label>
            </div>
            <div class="flex items-center gap-4 bg-[#211612] px-4 min-h-14 justify-between">
              <p class="text-white text-base font-normal leading-normal flex-1 truncate">Remember me</p>
              <div class="shrink-0">
                <div class="flex size-7 items-center justify-center">
                  <input
                    type="checkbox"
                    name="remember_me"
                    class="h-5 w-5 rounded border-[#634136] border-2 bg-transparent text-[#db5224] checked:bg-[#db5224] checked:border-[#db5224] checked:bg-[image:--checkbox-tick-svg] focus:ring-0 focus:ring-offset-0 focus:border-[#634136] focus:outline-none"
                  />
                </div>
              </div>
            </div>
            <a href="#" class="text-[#c5a296] text-sm font-normal leading-normal pb-3 pt-1 px-4 underline hover:text-white">Forgot password?</a>
            <div class="flex px-4 py-3">
              <button
                type="submit"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-5 flex-1 bg-[#db5224] text-white text-base font-bold leading-normal tracking-[0.015em]"
              >
                <span class="truncate">Log in</span>
              </button>
            </div>
            <p class="text-[#c5a296] text-sm font-normal leading-normal pb-3 pt-1 px-4 text-center">Don't have an account? <a href="createanaccount.php" class="underline hover:text-white">Sign up</a></p>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
