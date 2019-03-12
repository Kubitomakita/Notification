<div class="carrier-wizard" id="notification_carrier_wizard">
	<?php
		foreach ( notification_get_carriers() as $carrier ) {

			$tile_view = notification_create_view();

			$tile_view->set_vars( [
				'id'      => 'notification-carrier-' . $carrier->get_slug() . '-tile',
				'name'    => 'notification_carrier_' . $carrier->get_slug() . '_enable',
				'title'   => $carrier->get_name(),
				'content' => 'carrier description',
				'image'   => '<?xml version="1.0" standalone="no"?>
				<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
				 "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
				<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
				 width="1280.000000pt" height="1011.000000pt" viewBox="0 0 1280.000000 1011.000000"
				 preserveAspectRatio="xMidYMid meet">
				<g transform="translate(0.000000,1011.000000) scale(0.100000,-0.100000)"
				fill="#000000" stroke="none">
				<path d="M405 10100 c-187 -22 -312 -67 -371 -132 l-35 -39 48 -41 c99 -84
				320 -316 389 -408 150 -202 247 -391 310 -609 20 -68 37 -203 84 -666 33 -319
				67 -617 75 -663 46 -240 131 -439 270 -627 105 -142 147 -179 399 -347 288
				-192 354 -244 403 -316 32 -46 38 -63 38 -107 0 -58 -18 -91 -69 -129 -24 -19
				-42 -21 -149 -21 -204 1 -304 46 -601 270 -92 68 -185 134 -208 146 -89 45
				-167 3 -235 -127 -164 -313 -127 -629 107 -902 200 -234 628 -447 1040 -517
				212 -35 342 -38 760 -15 1003 55 1473 42 1940 -51 348 -70 622 -206 768 -382
				121 -147 187 -399 132 -506 -22 -45 -117 -132 -169 -158 -83 -40 -194 -8 -294
				85 -27 26 -119 133 -202 237 -84 105 -184 223 -221 264 -200 217 -445 334
				-774 372 -123 14 -328 7 -445 -16 -366 -70 -755 -300 -981 -580 -150 -185
				-227 -388 -227 -601 0 -117 15 -178 69 -289 61 -125 146 -235 322 -418 162
				-167 236 -267 302 -410 80 -174 114 -335 113 -542 0 -169 -16 -238 -124 -540
				-120 -336 -142 -457 -120 -641 38 -302 190 -519 444 -634 103 -46 100 -46 119
				8 36 100 135 229 271 351 112 101 223 182 493 362 826 550 1079 784 1278 1185
				118 238 161 428 176 779 14 315 33 448 92 613 61 175 109 250 259 407 123 129
				160 176 206 270 81 161 98 272 89 555 -28 904 -320 1764 -891 2625 -545 822
				-1317 1600 -2090 2108 -676 443 -1360 697 -2110 782 -162 18 -578 28 -680 15z"/>
				<path d="M11930 10104 c-835 -58 -1586 -317 -2325 -801 -773 -508 -1545 -1286
				-2090 -2108 -571 -861 -863 -1721 -891 -2625 -9 -283 8 -394 89 -555 46 -94
				83 -141 206 -270 150 -157 198 -232 259 -407 59 -165 78 -298 92 -613 14 -342
				57 -536 167 -763 198 -407 454 -646 1288 -1202 272 -181 381 -261 492 -361
				136 -122 235 -251 271 -351 19 -54 16 -54 119 -8 138 63 263 171 333 288 80
				136 130 357 117 521 -8 106 -43 232 -126 466 -108 302 -124 371 -124 540 -1
				207 33 368 113 542 66 143 140 243 302 410 176 183 261 293 322 418 54 111 69
				172 69 289 -1 404 -289 785 -783 1034 -210 106 -406 158 -635 169 -335 15
				-652 -75 -870 -247 -92 -73 -174 -164 -360 -395 -83 -104 -175 -211 -202 -237
				-107 -99 -225 -129 -309 -77 -58 35 -133 109 -155 151 -54 106 12 359 133 505
				146 176 420 312 768 382 467 93 937 106 1940 51 418 -23 548 -20 760 15 420
				72 830 277 1043 523 201 231 254 482 161 762 -73 224 -179 318 -292 261 -23
				-12 -116 -77 -206 -145 -199 -150 -279 -199 -394 -240 -79 -28 -98 -31 -209
				-31 -107 0 -125 2 -149 21 -51 38 -69 71 -69 129 0 44 6 61 38 107 49 72 115
				124 403 317 252 168 295 205 399 346 139 188 224 387 270 627 8 46 42 344 75
				663 47 463 64 598 84 666 63 218 160 407 310 609 69 92 290 324 389 408 l48
				41 -35 39 c-84 92 -244 131 -561 136 -121 2 -245 2 -275 0z"/>
				<path d="M7100 9552 c-82 -11 -127 -46 -137 -105 -5 -31 3 -50 57 -143 198
				-338 312 -626 327 -820 11 -147 -28 -344 -105 -522 -55 -125 -113 -218 -320
				-514 -240 -342 -240 -342 -72 -149 600 691 820 1356 634 1922 -72 220 -227
				354 -384 331z"/>
				<path d="M5385 9531 c-80 -36 -153 -137 -204 -283 -96 -275 -89 -573 19 -901
				88 -263 246 -530 472 -797 103 -121 297 -329 298 -319 0 4 -72 94 -161 200
				-203 246 -230 281 -271 354 -212 376 -249 915 -85 1240 16 33 55 98 87 145 81
				121 120 197 120 237 0 50 -33 108 -74 127 -47 22 -150 21 -201 -3z"/>
				<path d="M6324 6647 c-45 -60 -60 -93 -89 -192 -34 -118 -55 -284 -61 -495 -7
				-210 5 -325 71 -685 109 -588 110 -651 20 -1130 -66 -357 -80 -551 -51 -717
				15 -84 54 -179 89 -216 59 -64 163 -82 211 -37 36 34 89 150 115 254 37 148
				26 295 -49 638 -72 328 -90 434 -96 573 -8 162 1 255 61 610 24 146 49 321 56
				390 28 291 -22 634 -122 850 -39 82 -109 200 -119 200 -3 -1 -19 -20 -36 -43z"/>
				</g>
				</svg>
				',
				'open'    => $carrier->enabled,
			] );

			$tile_view->get_view( 'carrier/tile' );

		}
	?>
</div>
