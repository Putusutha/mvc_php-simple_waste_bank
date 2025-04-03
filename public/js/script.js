// Mengambil semua elemen tombol Salin & Cari Lokasi
const copyButtons = document.querySelectorAll('.copy-button');

// Menambahkan event listener untuk setiap tombol Salin & Cari Lokasi
copyButtons.forEach(button => {
    button.addEventListener('click', () => {
        let address = button.getAttribute('data-address');
        address = cleanAddress(address); // Clean the address before using it
        copyToClipboard(address);
        searchLocation(address);
    });
});

// Fungsi untuk membersihkan alamat dari spasi ekstra
function cleanAddress(address) {
    // Trim leading/trailing spaces and replace multiple spaces with a single space
    return address.trim().replace(/\s+/g, ' ');
}

// Fungsi untuk menyalin teks ke clipboard
function copyToClipboard(text) {
    const tempInput = document.createElement('textarea');
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
}

// Fungsi untuk mencari lokasi di Google Maps
function searchLocation(address) {
    // Encode address and build the URL
    const encodedAddress = encodeURIComponent(address);
    const googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodedAddress}`;
    console.log('Generated URL:', googleMapsUrl); // Debug output
    window.open(googleMapsUrl, '_blank');
}



  // function toggleDropdown() {
  //   var dropdownContent = document.getElementById("myDropdown");
  //   dropdownContent.classList.toggle("show");
  // }

  // // Tutup dropdown jika klik di luar dropdown
  // window.onclick = function(event) {
  //   if (!event.target.matches('.dropbtn')) {
  //     var dropdowns = document.getElementsByClassName("dropdown-content");
  //     for (var i = 0; i < dropdowns.length; i++) {
  //       var openDropdown = dropdowns[i];
  //       if (openDropdown.classList.contains('show')) {
  //         openDropdown.classList.remove('show');
  //       }
  //     }
  //   }
  // }
