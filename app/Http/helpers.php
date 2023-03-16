<?php

function rand_str($res_length = 10) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = strlen($chars);
    $result = '';
    for ($i = 0; $i < $res_length; $i++) 
        $result .= $chars[rand(0, $length - 1)];
    return $result;
}

function print_pdf(
    $file_name, 
    $content, 
    $paper_size = 'A4', 
    $orientation = false, 
    $return_file_name = false) {
    
    $orientation = $orientation ? 'Landscape' : 'Portrait';
    $unq_fname = rand_str(32);
    $html_path = storage_path('app/pdf/'.$unq_fname.'.html');
    $pdf_path  = storage_path('app/pdf/'.$unq_fname.'.pdf');
    
    File::put($html_path, $content);

    $gen_pdf_cmd = '';

    $gen_pdf_cmd = base_path('\vendor\nitmedia\wkhtml2pdf\src\Nitmedia\Wkhtml2pdf\lib\wkhtmltopdf.exe');

    // generate pdf using wkhtml2pdf
    $cmd = '--page-size '.$paper_size.' '.
            '--orientation '.$orientation.' '.
            '--javascript-delay 2000'.' ';

    exec('"'.$gen_pdf_cmd.'" '.
         $cmd . 
         '"'.$html_path.'" '.
         '"'.$pdf_path.'"', 
         $output);

    return 
      $return_file_name 
    ? $unq_fname
    : Response::make(file_get_contents($pdf_path), 200, [
          'Content-Type' => 'application/pdf',
          'Content-Disposition' => 'inline; filename="'.($file_name ? $file_name : time()).'.pdf"'
      ]);
}