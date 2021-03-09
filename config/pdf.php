<?php
return [
	'mode'                 => '',
	'format'               => 'A4',
	'default_font_size'    => '12',
	'default_font'         => 'thsarabunnew',
	'margin_left'          => 10,
	'margin_right'         => 10,
	'margin_top'           => 10,
	'margin_bottom'        => 10,
	'margin_header'        => 0,
	'margin_footer'        => 0,
	'orientation'          => 'P',
	'title'                => 'Laravel mPDF',
	'author'               => '',
	'watermark'            => '',
	'show_watermark'       => false,
	'watermark_font'       => 'thsarabunnew',
	'display_mode'         => 'fullpage',
	// 'SetCompression'         => 'false',
	'watermark_text_alpha' => 0.1,
	'custom_font_dir'      => base_path('public/assets/dashboard/fonts/'),
	'custom_font_data' 	   =>  [
                'thsarabunnew' => [
                    'R'  => 'thsarabunnew-webfont.ttf',    
                    'B'  => 'thsarabunnew_bold-webfont.ttf',       
                    'I'  => 'thsarabunnew_italic-webfont.ttf',    
                    'BI' => 'thsarabunnew_bolditalic-webfont.ttf' 
                ]
            ],
	'auto_language_detection'  => false,
	'temp_dir'               => base_path('public/storage/'),
	'pdfa' 			=> false,
	'pdfaauto' 		=> false,
	'justifyB4br' 	=> false,
];