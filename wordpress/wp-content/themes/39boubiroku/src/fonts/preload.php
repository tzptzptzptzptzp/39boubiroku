<?php
/**
 * Google Fonts プリロード
 *
 * パフォーマンス向上のため、指定したGoogleフォントファイルをプリロードします
 * functions.phpから読み込んで使用します
 */

/**
 * 指定したGoogleフォントファイルをプリロードする
 */
function preload_google_fonts() {
	// LCP（Largest Contentful Paint）に影響する、最も重要なフォントファイルのみをプリロードします
	// 全てのウェイトをプリロードすると、かえってパフォーマンスが低下する可能性があるため注意が必要です
	?>
	<link rel="preload" as="font" href="https://fonts.gstatic.com/s/shipporimincho/v16/VdGGAZweH5EbgHY6YT-YBaLiK0P-nX3QK6H-MAoJLJTOgOOl30CMPJsZKuI.0.woff2" crossorigin>
	<link rel="preload" as="font" href="https://fonts.gstatic.com/s/shipporimincho/v16/VdGGAZweH5EbgHY6YT-YBaLiK0P-nX3QK6H-MAoJLJTOgOOl30CMPJsZKuI.1.woff2" crossorigin>
	<?php
}
