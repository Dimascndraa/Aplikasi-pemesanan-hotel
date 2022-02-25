	function pilih() {
		var type = document.opsi.tipe.value;
		var teks = document.getElementById('tipe-kamar').options[document.getElementById('tipe-kamar').selectedIndex].text;
		document.opsi.harga.value = type;
		document.opsi.tipex.value = teks;

	}

//priview image untuk tambah dan ubah
function previewImage(){
    const gambar = document.querySelector('.gambar');
    const imgPreview = document.querySelector('.img-preview');

    const oFReader = new FileReader();
    oFReader.readAsDataURL(gambar.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };

}