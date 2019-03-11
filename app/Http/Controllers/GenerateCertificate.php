<?php

namespace App\Http\Controllers;


use App\EventRegistration;
use App\WorkshopRegistration;
use Codedge\Fpdf\Fpdf\Fpdf;

class GenerateCertificate extends Controller
{
    //

    /**
     * @param $orderId
     * @param Codedge\Fpdf\Fpdf\Fpdf $fpdf
     */
    public function createEventCertificate($orderId, Fpdf $fpdf) {
        $certificate_path = public_path('img/event-certificate.png');

        $im = imagecreatefrompng($certificate_path);
        $text_font_filepath = public_path("fonts/nexa-bold.ttf");
        $barcode_font_filepath = public_path("fonts/LibreBarcode128Text-Regular.ttf");

        $event_reg = EventRegistration::with('user', 'event')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $name = $event_reg->user->name;
        $college = $event_reg->user->college_name;
        $event = $event_reg->event->name;


        $cor = imagecolorallocate($im, 0, 0, 0);

        $image_width = imagesx($im);
        $image_height = imagesy($im);

        $name_box = imagettfbbox(50,0, $text_font_filepath, $name);
        $college_box = imagettfbbox(50,0, $text_font_filepath, $college);
        $event_box = imagettfbbox(50,0, $text_font_filepath, $event);
        $barcode_box = imagettfbbox(80,0, $barcode_font_filepath, $orderId);


        $namex = $name_box[0] + ($image_width / 2) - ($name_box[4] / 2) + 950;
        $namey = $name_box[1] + ($image_height / 2) - ($name_box[5] / 2) - 40;

        $collegex = $college_box[0] + ($image_width / 2) - ($college_box[4] / 2) + 220;
        $collegey = $college_box[1] + ($image_height / 2) - ($college_box[5] / 2) + 80;

        $eventx = $event_box[0] + ($image_width / 2) - ($event_box[4] / 2) + 700;
        $eventy = $event_box[1] + ($image_height / 2) - ($event_box[5] / 2) + 230;

        $barcodex = $barcode_box[0] + ($image_width / 2) - ($barcode_box[4] / 2) - 1430;
        $barcodey = $barcode_box[1] + ($image_height / 2) - ($barcode_box[5] / 2) + 1070;


        imagettftext($im, 50, 0, $namex, $namey, $cor, $text_font_filepath, $name);

        imagettftext($im, 50, 0, $collegex, $collegey, $cor, $text_font_filepath, $college);

        imagettftext($im, 50, 0, $eventx, $eventy, $cor, $text_font_filepath, $event);

        imagettftext($im, 80, 0, $barcodex, $barcodey, $cor, $barcode_font_filepath, $orderId);

        $final_certificate_path = storage_path('temp/'. $orderId .'.png');
        imagepng($im, $final_certificate_path );
        imagedestroy($im);

        $fpdf->AddPage('L');
        $fpdf->SetAutoPageBreak(true, 1);
        $fpdf->SetCreator("Xplore'19");
        $fpdf->SetAuthor("Muhammed Shasin P");
        $fpdf->SetCompression(true);
        $fpdf->SetTitle("$name - $orderId");
        $fpdf->Image($final_certificate_path,0,0,$fpdf->GetPageWidth(),$fpdf->GetPageHeight());
        unlink($final_certificate_path);
        $fpdf->Output('I', 'Certificate-' . $orderId . '.pdf');
    }

    /**
     * @param $orderId
     * @param Fpdf $fpdf
     */
    public function createWorkshopCertificate($orderId, Fpdf $fpdf)
    {
        $certificate_path = public_path('img/workshop-certificate.png');

        $im = imagecreatefrompng($certificate_path);
        $text_font_filepath = public_path("fonts/nexa-bold.ttf");
        $barcode_font_filepath = public_path("fonts/LibreBarcode128Text-Regular.ttf");

        $workshop_reg = WorkshopRegistration::with('user', 'workshop')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $name = $workshop_reg->user->name;
        $college = $workshop_reg->user->college_name;
        $event = $workshop_reg->workshop->name;


        $cor = imagecolorallocate($im, 0, 0, 0);

        $image_width = imagesx($im);
        $image_height = imagesy($im);

        $name_box = imagettfbbox(50,0, $text_font_filepath, $name);
        $college_box = imagettfbbox(50,0, $text_font_filepath, $college);
        $event_box = imagettfbbox(50,0, $text_font_filepath, $event);
        $barcode_box = imagettfbbox(80,0, $barcode_font_filepath, $orderId);


        $namex = $name_box[0] + ($image_width / 2) - ($name_box[4] / 2) + 950;
        $namey = $name_box[1] + ($image_height / 2) - ($name_box[5] / 2) - 40;

        $collegex = $college_box[0] + ($image_width / 2) - ($college_box[4] / 2) + 220;
        $collegey = $college_box[1] + ($image_height / 2) - ($college_box[5] / 2) + 80;

        $eventx = $event_box[0] + ($image_width / 2) - ($event_box[4] / 2) + 700;
        $eventy = $event_box[1] + ($image_height / 2) - ($event_box[5] / 2) + 230;

        $barcodex = $barcode_box[0] + ($image_width / 2) - ($barcode_box[4] / 2) - 1430;
        $barcodey = $barcode_box[1] + ($image_height / 2) - ($barcode_box[5] / 2) + 1070;



        imagettftext($im, 50, 0, $namex, $namey, $cor, $text_font_filepath, $name);

        imagettftext($im, 50, 0, $collegex, $collegey, $cor, $text_font_filepath, $college);

        imagettftext($im, 50, 0, $eventx, $eventy, $cor, $text_font_filepath, $event);

        imagettftext($im, 80, 0, $barcodex, $barcodey, $cor, $barcode_font_filepath, $orderId);


        $final_certificate_path = storage_path('temp/'. $orderId .'.png');
        imagepng($im, $final_certificate_path );
        imagedestroy($im);

        $fpdf->AddPage('L');
        $fpdf->SetAutoPageBreak(true, 1);
        $fpdf->SetCreator("Xplore'19");
        $fpdf->SetAuthor("Muhammed Shasin P");
        $fpdf->SetCompression(true);
        $fpdf->SetTitle("$name - $orderId");
        $fpdf->Image($final_certificate_path,0,0,$fpdf->GetPageWidth(),$fpdf->GetPageHeight());
        unlink($final_certificate_path);
        $fpdf->Output('I', 'Certificate-' . $orderId . '.pdf');
    }
}
