<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    private function generateGraph()
    {
        $max     = 100;
        $step    = 20;

        $title = 'Bar and Line Graph';
        $bar = array(20, 50, 40, 80, 100, 90, 70, 70, 70, 70, 70, 70, 70, 70, 70);
        $line = array(20, 50, 40, 80, 100, 90, 70, 70, 70, 70, 70, 70, 70, 70, 70);

        $label = array('55歳', '56歳', '57歳', '58歳', '59歳', '60歳', '61歳', '62歳', '63歳', '64歳', '65歳', '66歳', '67歳', '68歳', '69歳');

        $show_legend = true;

        // サイズがA4,DPIが72のとき幅595で横いっぱいになる($width + $margin_left + $margin_right = 595)
        // 横幅が確定してから調整すればいいと思います。
        // 固定値を埋め込まず比率で計算してあげるといいと思います。(難しそうであれば固定値で実装後、あとから調整)
        $width   = 435;
        $height  = 200;
        $margin_top      = 50;
        $margin_right    = 80;
        $margin_bottom   = 50;
        $margin_left     = 80;

        $font = storage_path('fonts/ipag.ttf');
        $font_size = 10;

        $image = imagecreatetruecolor($width + $margin_left + $margin_right, $height + $margin_top + $margin_bottom);
        imageantialias($image, true);

        $org_x = $margin_left;
        $org_y = $height + $margin_top;

        $bg_color   = imagecolorallocate($image, 10, 10, 10);
        $line_color = imagecolorallocate($image, 255, 255, 255);
        $bar_color  = imagecolorallocate($image, 100, 180, 255);
        $text_color = imagecolorallocate($image, 255, 255, 255);
        $grid_color = imagecolorallocate($image, 50, 50, 50);
        $grid_spacing = $height / $max * $step;
        $bar_width = 20;

        imagefill($image, 0, 0, $bg_color);

        // グラフの縦軸の値とメモリ線を描画
        for ($i = 0; $i <= floor($max / $step); $i++) {
            if ($i !== 0) {
                imageline($image, $org_x, $org_y - $grid_spacing * $i, $org_x + $width, $org_y - $grid_spacing * $i, $grid_color);
            }

            $text = $i * $step;
            $box = imagettfbbox($font_size, 0, $font, $text);
            $text_width = $box[2] - $box[6];
            $text_height = $box[3] - $box[7];

            $text_x = $org_x - $font_size;
            $text_y = $org_y - $grid_spacing * $i;
            imagettftext($image, $font_size, 0, (-1 * $text_width) + $text_x, ($text_height / 2) + $text_y, $text_color, $font, $text);
        }


        $count = count($label);

        // 棒グラフを描画
        $bar_spacing = floor(($width - $bar_width) / $count);

        for ($i = 0; $i < $count; $i++) {
            $bar_x = $org_x + $bar_spacing * ($i + 1) - ($bar_spacing / 2);
            $bar_y = $org_y - $height * $bar[$i] / $max;

            imagefilledrectangle($image, $bar_x, $org_y, $bar_x + $bar_width, $bar_y, $bar_color);
        }

        // 折れ線グラフを描画
        $line_spacing = floor($width / $count);

        for ($i = 0; $i < $count; $i++) {
            $graph_x = $org_x + $line_spacing * $i + round($line_spacing / 2);
            $graph_y = $org_y - $height * $line[$i] / $max;

            if (isset($prev)) {
                imageline($image, $prev[0], $prev[1], $graph_x, $graph_y, $line_color);
            }
            imagefilledrectangle($image, $graph_x - 2, $graph_y - 2, $graph_x + 2, $graph_y + 2, $line_color);

            $prev = array($graph_x, $graph_y);
        }

        // $legend_x = $org_x + $width + 20;
        // $legend_y = $margin_top + 10;

        // foreach ($lines as $line) {
        //     $values = $line['values'];
        //     $graph_color  = imagecolorallocate($image, $line['color'][0], $line['color'][1], $line['color'][2]);

        //     for ($i=0;$i<$count;$i++) {
        //         $graph_x = $org_x + $graph_spacing * $i + round($graph_spacing / 2);
        //         $graph_y = $org_y - $height * $values[$i] / $max;

        //         if (isset($prev)) {
        //             imageline($image, $prev[0], $prev[1], $graph_x, $graph_y, $graph_color);
        //         }
        //         imagefilledrectangle($image, $graph_x - 2, $graph_y - 2, $graph_x + 2, $graph_y + 2, $graph_color);


        //         $prev = array($graph_x,$graph_y);
        //     }

        //     凡例を作っているところ
        //     if ($show_legend) {
        //         $text = $line['name'];
        //         $box = imagettfbbox($font_size, 0, $font, $text);
        //         $text_width = $box[2] - $box[6];
        //         $text_height = $box[3] - $box[7];
        //         imagettftext($image, $font_size, 0, $legend_x, $legend_y, $graph_color, $font, '● ' . $text);
        //         $legend_y = $legend_y + ($text_height * 2);
        //     }
        //     unset($prev);
        // }

        // グラフの横軸のテキストを描画
        for ($i = 0; $i < $count; $i++) {
            $graph_x = $org_x + $line_spacing * $i + round($line_spacing / 2);

            $text = $label[$i];
            $box = imagettfbbox($font_size, 0, $font, $text);
            $text_width = $box[2] - $box[6];
            $text_height = $box[3] - $box[7];

            $text_x = round((-1 * $text_width / 2)) + $graph_x;
            $text_y = ($text_height / 2) + $org_y + $font_size * 2;
            imagettftext($image, $font_size, 0, $text_x, $text_y, $text_color, $font, $text);
        }

        // 縦/横の軸線を描画
        imageline($image, $org_x, $org_y, $org_x, $margin_top, $text_color);
        imageline($image, $org_x, $org_y, $org_x + $width, $org_y, $text_color);

        // グラフタイトルを描画
        $box = imagettfbbox($font_size, 0, $font, $title);
        $text_width  = $box[2] - $box[6];
        $text_height = $box[3] - $box[7];
        $text_x = $org_x + $width / 2 - ($text_width / 2);
        $text_y = $org_y - $height - $font_size * 2;
        imagettftext($image, $font_size, 0, $text_x, $text_y, $text_color, $font, $title);

        // 出力バッファをopen
        ob_start();
        // バッファ内にjpegとしてグラフを出力
        imagejpeg($image, null, 90);
        // バッファ内のグラフを変数に格納し、バッファをclose
        $graph = base64_encode(ob_get_clean());
        // imageをメモリから解放
        imagedestroy($image);

        return $graph;
    }

    public function index(Request $request)
    {
        $post_data = $request->all();
        $graph = $this->generateGraph();

        $pdf = PDF::loadView('pdf', compact('post_data', 'graph'));

        // オプションのデフォルト(サイズとDPIのみ抜粋 ※githubより])
        // defaultPaperSize: "a4" (available in config/dompdf.php)
        // dpi: 96 (available in config/dompdf.php)
        return $pdf->setOptions(['dpi' => 72])->download('test.pdf');
    }
}
