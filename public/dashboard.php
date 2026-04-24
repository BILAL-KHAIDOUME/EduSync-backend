<?php
session_start();
include("../scripts/database.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Elmwood Academy — Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { font-family: 'Segoe UI', system-ui, sans-serif; }
    .bar-fill { transition: width 0.6s ease; }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 flex h-screen overflow-hidden">

  <!-- Sidebar -->
  <aside class="w-56 flex-shrink-0 bg-white border-r border-gray-100 flex flex-col py-6">
    <div class="px-5 pb-5 border-b border-gray-100">
      <div class="text-sm font-semibold text-gray-900">Elmwood Academy</div>
      <div class="text-xs text-gray-400 mt-0.5">Student Portal</div>
    </div>

    <nav class="flex-1 px-3 py-4 flex flex-col gap-0.5">
      <button onclick="setActive(this)" class="nav-item active flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/>
          <rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/>
        </svg>
        Overview
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M2 3h12M2 8h12M2 13h8"/>
        </svg>
        Assignments
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="2" y="2" width="12" height="12" rx="1.5"/>
          <path d="M5 2v12M2 6h3M2 10h3"/>
        </svg>
        Schedule
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
        </svg>
        Teachers
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M8 1l2 4 5 .7-3.5 3.4.8 4.9L8 12l-4.3 2 .8-4.9L1 5.7 6 5z"/>
        </svg>
        Grades
      </button>
      <button onclick="setActive(this)" class="nav-item flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-900 w-full text-left transition-colors">
        <svg class="w-4 h-4 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M2 13V6l6-4 6 4v7H2z"/><rect x="6" y="8" width="4" height="5" rx="0.5"/>
        </svg>
        Library
      </button>
    </nav>

    <!-- Logout Button -->
    <div class="px-3">
        <form action="../scripts/logout.php" method="post">

            <button name="logout" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 border border-red-200 hover:bg-red-50 w-full text-left transition-colors">
              
              Log out
            </button>

        </form>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 flex flex-col overflow-auto">

    <!-- Top Bar -->
    <div class="bg-white border-b border-gray-100 px-6 h-14 flex items-center justify-between flex-shrink-0">
      <span class="text-sm font-medium text-gray-900">Good morning, <?php 

      $log_email = $_SESSION['email'];

      $sql = "SELECT firstname from users where email = '$log_email' ";
      
      $result = mysqli_query($conn , $sql );
      
      $row = mysqli_fetch_assoc($result);
      
      echo $row['firstname'];
      mysqli_close($conn);

      ?> </span>
      <div class="flex items-center gap-3">
        <span class="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full border border-gray-100">Spring 2026</span>
        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-xs font-medium text-blue-700">AJ</div>
      </div>
    </div>

    <div class="p-6 flex flex-col gap-5">

      <!-- Metric Cards -->
      <div class="grid grid-cols-4 gap-3">
        <div class="bg-gray-50 rounded-xl p-4">
          <div class="text-xs text-gray-400 mb-1.5">GPA</div>
          <div class="text-2xl font-medium text-gray-900">3.8</div>
          <div class="text-xs text-green-500 mt-1">▲ 0.2 from last term</div>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
          <div class="text-xs text-gray-400 mb-1.5">Attendance</div>
          <div class="text-2xl font-medium text-gray-900">96%</div>
          <div class="text-xs text-gray-400 mt-1">18 / 19 days</div>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
          <div class="text-xs text-gray-400 mb-1.5">Assignments due</div>
          <div class="text-2xl font-medium text-gray-900">3</div>
          <div class="text-xs text-red-400 mt-1">▼ 2 this week</div>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
          <div class="text-xs text-gray-400 mb-1.5">Credits earned</div>
          <div class="text-2xl font-medium text-gray-900">42</div>
          <div class="text-xs text-gray-400 mt-1">of 120 required</div>
        </div>
      </div>

      <!-- Middle Row -->
      <div class="grid grid-cols-2 gap-5">

        <!-- Subject Performance -->
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
          <div class="text-xs font-medium text-gray-700 mb-4">Subject performance</div>
          <div id="subjects" class="flex flex-col gap-3"></div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white border border-gray-100 rounded-2xl p-5">
          <div class="text-xs font-medium text-gray-700 mb-4">Upcoming events</div>
          <div id="events" class="flex flex-col gap-2"></div>
        </div>
      </div>

      <!-- Notices -->
      <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <div class="text-xs font-medium text-gray-700 mb-4">Notices &amp; announcements</div>
        <div id="notices" class="flex flex-col gap-2"></div>
      </div>

    </div>
  </main>

  <script>
    // Active nav state
    document.querySelectorAll('.nav-item').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.nav-item').forEach(b => {
          b.classList.remove('bg-gray-100', 'text-gray-900', 'font-medium');
          b.classList.add('text-gray-500');
        });
        btn.classList.add('bg-gray-100', 'text-gray-900', 'font-medium');
        btn.classList.remove('text-gray-500');
      });
    });
    // Set first item active on load
    const first = document.querySelector('.nav-item');
    first.classList.add('bg-gray-100', 'text-gray-900', 'font-medium');
    first.classList.remove('text-gray-500');

    function setActive(el) {
      document.querySelectorAll('.nav-item').forEach(i => {
        i.classList.remove('bg-gray-100', 'text-gray-900', 'font-medium');
        i.classList.add('text-gray-500');
      });
      el.classList.add('bg-gray-100', 'text-gray-900', 'font-medium');
      el.classList.remove('text-gray-500');
    }

    // Subjects
    const subjects = [
      { name: "Mathematics", pct: 91, color: "#378ADD" },
      { name: "English",     pct: 85, color: "#1D9E75" },
      { name: "Chemistry",   pct: 78, color: "#BA7517" },
      { name: "History",     pct: 88, color: "#7F77DD" },
      { name: "Physics",     pct: 73, color: "#D85A30" },
    ];
    const subContainer = document.getElementById("subjects");
    subjects.forEach(s => {
      subContainer.innerHTML += `
        <div class="flex items-center gap-3">
          <span class="text-xs text-gray-600 w-24 shrink-0">${s.name}</span>
          <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
            <div class="bar-fill h-full rounded-full" style="width:${s.pct}%; background:${s.color}"></div>
          </div>
          <span class="text-xs text-gray-400 w-9 text-right">${s.pct}%</span>
        </div>`;
    });

    // Events
    const events = [
      { day: 25, month: "APR", name: "Chemistry mid-term",  type: "Exam",       color: "#BA7517" },
      { day: 28, month: "APR", name: "Essay submission",    type: "Assignment",  color: "#378ADD" },
      { day: 2,  month: "MAY", name: "Spring concert",      type: "Event",       color: "#1D9E75" },
      { day: 6,  month: "MAY", name: "Parent–teacher day",  type: "Meeting",     color: "#7F77DD" },
    ];
    const evContainer = document.getElementById("events");
    events.forEach(e => {
      evContainer.innerHTML += `
        <div class="flex items-center gap-3 p-2.5 rounded-xl border border-gray-100 bg-gray-50">
          <div class="w-10 text-center shrink-0">
            <strong class="block text-base font-medium text-gray-900">${e.day}</strong>
            <span class="text-xs text-gray-400">${e.month}</span>
          </div>
          <div class="flex-1">
            <div class="text-xs font-medium text-gray-800">${e.name}</div>
            <div class="text-xs text-gray-400">${e.type}</div>
          </div>
          <div class="w-2 h-2 rounded-full shrink-0" style="background:${e.color}"></div>
        </div>`;
    });

    // Notices
    const notices = [
      { title: "Library hours extended",      body: "The library will now be open until 7 pm on weekdays through exam season.", color: "#378ADD" },
      { title: "Science fair registrations open", body: "Submit your project proposal by May 3rd to secure a spot.",          color: "#1D9E75" },
      { title: "Cafeteria menu update",        body: "New spring menu launches Monday. Dietary info available on request.",   color: "#BA7517" },
    ];
    const notContainer = document.getElementById("notices");
    notices.forEach(n => {
      notContainer.innerHTML += `
        <div class="px-4 py-3 rounded-xl bg-gray-50 border-l-4" style="border-color:${n.color}">
          <div class="text-xs font-medium text-gray-800">${n.title}</div>
          <div class="text-xs text-gray-400 mt-0.5">${n.body}</div>
        </div>`;
    });
  </script>
</body>
</html>