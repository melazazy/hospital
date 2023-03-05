// let sidebar = document.querySelector(".sidebar");
// let sidebarA = document.querySelector(".sidebar li a");
// let logo_name = document.querySelector(".logo_name");
// let sidebarBtns = document.querySelectorAll(".sidebarBtn");
// sidebarBtns.forEach(sidebarBtn => {
//     sidebarBtn.onclick = function () {
//         sidebar.classList.toggle("active");
//         if (logo_name.innerHTML == 'Hospital') {
//             logo_name.innerHTML = "<i class='bx bx-heading text-info'></i>";
//         }
//         else {
//             logo_name.innerHTML = 'Hospital';
//         }
//         // sidebarA.classList.toggle("active");
//         if (sidebar.classList.contains("active")) {
//             sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
//         } else
//             sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
//     };
// });
// // sidebar.offsetWidth.change(function () {
// //     let w = sidebar.offsetWidth;
// //     console.log('Width' + w);
// // });
// let link = document.querySelectorAll(".links_name");
// link.forEach(linkBtn => {
//     linkBtn.closest('a').onclick = function () {
//         if (linkBtn.classList.contains("logout")) {
//             event.preventDefault();
//             let log = document.getElementById('logout-form').submit();
//         }
//         else if (linkBtn.nextElementSibling.classList.contains("bx-chevrons-right")) {
//             linkBtn.nextElementSibling.classList.replace("bx-chevrons-right", "bx-chevrons-down");
//         } else
//             linkBtn.nextElementSibling.classList.replace("bx-chevrons-down", "bx-chevrons-right");
//     };
// });


// // const myModal = document.getElementById('24');
// // const myInput = document.getElementById('myInput');

// // myModal.addEventListener('shown.bs.modal', () => {
// //     myInput.focus();
// // });
