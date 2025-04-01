// document.addEventListener("DOMContentLoaded", () => {
//   flatpickr("#dob", {
//     enableTime: false,
//     dateFormat: "Y-m-d",
//     wrap: false,
//     static: true,
//     appendTo: document.body,
//     locale: {
//       firstDayOfWeek: 1, // Set the week to start on Monday
//     },
//     onReady(_, __, fp) {
//       // Add Choose Date and Cancel buttons
//       const footer = document.createElement("div");
//       footer.className = "flex justify-between mt-2 px-3 py-1";

//       const chooseBtn = document.createElement("button");
//       chooseBtn.textContent = "Choose Date";
//       chooseBtn.className =
//         "px-4 py-2 text-white bg-blue-900 hover:bg-blue-600 rounded-lg";
//       chooseBtn.addEventListener("click", () => {
//         fp.close();
//       });

//       const cancelBtn = document.createElement("button");
//       cancelBtn.textContent = "Cancel";
//       cancelBtn.className =
//         "px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 rounded-lg";
//       cancelBtn.addEventListener("click", () => {
//         fp.clear();
//         fp.close();
//       });

//       footer.appendChild(cancelBtn);
//       footer.appendChild(chooseBtn);

//       fp.calendarContainer.appendChild(footer);
//     },
//   });
// });

// logic for hamburger

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const body = document.body;
  sidebar.classList.toggle("open");
  body.classList.toggle("sidebar-open");
  console.log("Sidebar toggle: ", sidebar.classList.contains("open"));
}

// function toggleSidebar() {
//   const sidebar = document.getElementById("sidebar");
//   const body = document.body;
//   sidebar.classList.toggle("open");
//   console.log("open", sidebar.classList.toggle("open"));
//   body.classList.toggle("sidebar-open");
//   console.log("Sidebar toggle: ", sidebar.classList.contains("open"));
// }

// function toggleSidebar() {
//   const sidebar = document.getElementById("sidebar");
//   const body = document.body;

//   if (sidebar.classList.contains("open")) {
//     sidebar.classList.remove("open");
//     body.classList.remove("sidebar-open");
//   } else {
//     sidebar.classList.add("open");
//     body.classList.add("sidebar-open");
//   }
// }

// function toggleSidebar() {
//   const sidebar = document.getElementById("sidebar");
//   const body = document.body;

//   sidebar.classList.toggle("open");

//   body.classList.toggle("sidebar-open");
// }

// function closeSidebar() {
//   const sidebar = document.getElementById("sidebar");
//   const body = document.body;

//   sidebar.classList.remove("open");

//   console.log("Sidebar Open class removed: ", !sidebar.classList.contains("open"));

//   body.classList.remove("sidebar-open");

//   console.log("Sidebar Open class removed from body: ", !body.classList.contains("sidebar-open"));
// }



// JavaScript for opening and closing language change form
function toggleLanguageForm() {
  const form = document.getElementById("languageForm");
  form.classList.toggle("hidden");
}

// JavaScript for opening and closing edit profile form
function toggleEditProfileForm() {
  const form = document.getElementById("EditProfileForm");
  form.classList.toggle("hidden");
}

// JavaScript for sort popup
function toggleFilterForm() {
  const form = document.getElementById("toggleSortPopUp()");
  form.classList.toggle("hidden");
}

// JavaScript for filter form popup
function toggleSortPopUp() {
  const form = document.getElementById("togglePopUp");
  form.classList.toggle("hidden");
}

// JavaScript for opportunity popup
function toggleOpportunityPopUp() {
  const form = document.getElementById("toggleOpportunity");
  form.classList.toggle("hidden");
}

// Pathway Details popup
function togglePathwayDetailsPopUp() {
  const form = document.getElementById("togglePathwayDetails");
  form.classList.toggle("hidden");
}

// upload file Add Opportunity
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file) {
    document.getElementById("file-name").textContent = file.name;
  }
}

// Remove file Add Opportunity
function removeFile() {
  document.getElementById("file-name").textContent = "No file chosen";
  document.getElementById("file-upload").value = "";
}

//  - upload documents
// document.getElementById("toggleButton").addEventListener("click", function () {
//   const fileUploadDiv = document.getElementById("fileUploadDiv");
//   fileUploadDiv.classList.toggle("hidden");
// });

document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggleButton");
  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      const fileUploadDiv = document.getElementById("fileUploadDiv");
      fileUploadDiv.classList.toggle("hidden");
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggleButton2");
  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      const fileUploadDiv = document.getElementById("fileUploadDiv2");
      fileUploadDiv.classList.toggle("hidden");
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggleButton3");
  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      const fileUploadDiv = document.getElementById("fileUploadDiv3");
      fileUploadDiv.classList.toggle("hidden");
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggleButton4");
  if (toggleButton) {
    toggleButton.addEventListener("click", function () {
      const fileUploadDiv = document.getElementById("fileUploadDiv4");
      fileUploadDiv.classList.toggle("hidden");
    });
  }
});

// const uploadBtn = document.getElementById('uploadOptionsBtn');
//   const uploadMenu = document.getElementById('uploadOptionsMenu');

//   uploadBtn.addEventListener('click', () => {
//     uploadMenu.classList.toggle('hidden');
//   });

//   document.getElementById('uploadFromDevice').addEventListener('click', () => {
//     document.getElementById('upload_profile_photo').click();
//     uploadMenu.classList.add('hidden');
//   });

//   document.getElementById('uploadFromCamera').addEventListener('click', () => {
//     const cameraInput = document.createElement('input');
//     cameraInput.type = 'file';
//     cameraInput.accept = 'image/*';
//     cameraInput.capture = 'camera';
//     cameraInput.click();
//     uploadMenu.classList.add('hidden');
//   });

// upload documnet icon
function toggleIcons(active) {
  const icon1 = document.getElementById("icon1");
  const icon2 = document.getElementById("icon2");

  if (active === 1) {
    icon1.classList.add("text-gray-400", "pointer-events-none");
    icon2.classList.remove("text-gray-400", "pointer-events-none");
    icon2.classList.add("text-gray-700");
  } else {
    icon2.classList.add("text-gray-400", "pointer-events-none");
    icon1.classList.remove("text-gray-400", "pointer-events-none");
    icon1.classList.add("text-gray-700");
  }
}

// Handle screen transitions and remember the current screen
function showScreen1() {
  document.getElementById("screen1").classList.remove("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen1");
}

function showScreen2() {
  // document.getElementById("screen1").classList.add("hidden");
  // document.getElementById("screen2").classList.remove("hidden");
  // document.getElementById("screen3").classList.add("hidden");
  // document.getElementById("screen4").classList.add("hidden");
  // document.getElementById("screen5").classList.add("hidden");
  // document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  // document.getElementById("screen8").classList.add("hidden");
  // document.getElementById("screen9").classList.add("hidden");
  // document.getElementById("screen10").classList.add("hidden");
  // document.getElementById("screen11").classList.add("hidden");
  // document.getElementById("screen12").classList.add("hidden");
  // document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen2");
}

function showScreen3(event) {
  event.preventDefault(); // Prevent form submission
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.remove("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen3");
}

function showScreen4(event) {
  event.preventDefault(); // Prevent form submission
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.remove("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen4");
}

function showScreen5(event) {
  event.preventDefault(); // Prevent form submission
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.remove("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen5");
}

function showScreen6(event) {
  event.preventDefault(); // Prevent form submission
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.remove("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen6");
}

// to-do tasks
function showScreen7() {
  // event.preventDefault();
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  document.getElementById("screen7").classList.remove("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen7");
}

function showScreen8() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.remove("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen8");
}

function showScreen9() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.remove("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen9");
}

function showScreen10() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.remove("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen10");
}

function showScreen11() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.remove("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen11");
}

function showScreen12() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.remove("hidden");
  document.getElementById("screen13").classList.add("hidden");
  localStorage.setItem("currentScreen", "screen12");
}

function showScreen13() {
  document.getElementById("screen1").classList.add("hidden");
  document.getElementById("screen2").classList.add("hidden");
  document.getElementById("screen3").classList.add("hidden");
  document.getElementById("screen4").classList.add("hidden");
  document.getElementById("screen5").classList.add("hidden");
  document.getElementById("screen6").classList.add("hidden");
  // document.getElementById("screen7").classList.add("hidden");
  document.getElementById("screen8").classList.add("hidden");
  document.getElementById("screen9").classList.add("hidden");
  document.getElementById("screen10").classList.add("hidden");
  document.getElementById("screen11").classList.add("hidden");
  document.getElementById("screen12").classList.add("hidden");
  document.getElementById("screen13").classList.remove("hidden");
  localStorage.setItem("currentScreen", "screen13");
}

window.onload = function () {
  const savedScreen = localStorage.getItem("currentScreen");
  if (savedScreen === "screen1") {
    showScreen1();
  } else if (savedScreen === "screen2") {
    showScreen2();
  } else if (savedScreen === "screen3") {
    showScreen3(event);
  } else if (savedScreen === "screen4") {
    showScreen4(event);
  } else if (savedScreen === "screen5") {
    showScreen5(event);
  } else if (savedScreen === "screen6") {
    showScreen6(event);
    // } else if (savedScreen === "screen7") {
    //   showScreen7();
  } else if (savedScreen === "screen8") {
    showScreen8();
  } else if (savedScreen === "screen9") {
    showScreen9();
  } else if (savedScreen === "screen10") {
    showScreen10();
  } else if (savedScreen === "screen11") {
    showScreen11();
  } else if (savedScreen === "screen12") {
    showScreen12();
  } else if (savedScreen === "screen13") {
    showScreen13();
  } else {
    showScreen1();
  }
};
