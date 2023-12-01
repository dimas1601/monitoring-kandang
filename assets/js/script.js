// const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// allSideMenu.forEach(item=> {
// 	const li = item.parentElement;

// 	item.addEventListener('click', function () {
// 		allSideMenu.forEach(i=> {
// 			i.parentElement.classList.remove('active');
// 		})
// 		li.classList.add('active');
// 	})
// });

// // TOGGLE SIDEBAR
// const menuBar = document.querySelector('#content nav .bx.bx-menu');
// const sidebar = document.getElementById('sidebar');

// menuBar.addEventListener('click', function () {
// 	sidebar.classList.toggle('hide');
// })
// Mengambil elemen-elemen yang diperlukan
const sidebar = document.getElementById('sidebar');
const menuBar = document.querySelector('#content nav .bx.bx-menu');

// Fungsi untuk mengecek dan menetapkan kelas hide pada sidebar
function checkAndSetSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add('hide');
  } else {
    sidebar.classList.remove('hide');
  }
}

// Memanggil fungsi pada saat halaman dimuat dan saat ukuran layar berubah
window.addEventListener('load', checkAndSetSidebar);
window.addEventListener('resize', checkAndSetSidebar);

// TOGGLE SIDEBAR
menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide');
});
