<?php
function indo_currency($nominal) {
    $result = "Rp " . number_format($nominal, 0, ',', '.');
    return $result;
    }
    if (!function_exists('generate_invoice_code')) {
        function generate_invoice_code() {
            // Ambil nomor urut terakhir dari database atau sesuai kebutuhan Anda
            // Contoh: $last_invoice_number = $this->Madmin->get_last_invoice_number();
            $last_invoice_number = 1;
    
            // Format kode invoice dengan "TRNS" dan tambahkan leading zeros
            $invoice_code = 'TRNS' . str_pad($last_invoice_number, 3, '0', STR_PAD_LEFT);
    
            return $invoice_code;
        }
    }
?>