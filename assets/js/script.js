$(document).ready(function() {
    $('#nomorIdentitas').on('input', function() {
        var input=$(this);
        var re=/^\d{16}$/;
        if(!re.test(input.val())) {
            input.addClass('is-invalid');
            input.removeClass('is-valid');
        } else {
            input.removeClass('is-invalid');
            input.addClass('is-valid');
        }
    });

    $('#durasiMenginap').on('input', function() {
        var input=$(this);
        var re=/^\d+$/;
        if(!re.test(input.val())) {
            input.addClass('is-invalid');
            input.removeClass('is-valid');
        } else {
            input.removeClass('is-invalid');
            input.addClass('is-valid');
        }
    });

    $('#hitungTotal').click(function() {
        var tipeKamar = $('#tipeKamar').val();
        var durasiMenginap = parseInt($('#durasiMenginap').val());
        var breakfast = $('#breakfast').is(':checked');
        var harga;

        switch(tipeKamar) {
            case 'standar':
                harga = 300000;
                break;
            case 'deluxe':
                harga = 500000;
                break;
            case 'family':
                harga = 900000;
                break;
        }
    

        var total = harga * durasiMenginap;

        if(durasiMenginap > 2) {
            total *= 0.9; // Apply 10% discount
        }
        
        if(breakfast) {
            total += (80000 * durasiMenginap); // Add breakfast cost to total
        }
        $('#totalBayar').val("Rp."+total.toLocaleString());
    });
});
