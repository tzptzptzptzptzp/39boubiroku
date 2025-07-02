.PHONY: up down restart logs ps shell db-shell clean fulldown reset

# コンテナをバックグラウンドで起動する
up:
	docker-compose up -d 2>/dev/null || (echo "コンテナ名の競合を検出しました。既存のコンテナを再利用します..." && \
	docker start my-wp-db my-wp-site my-wp-phpmyadmin 2>/dev/null)
	@echo "コンテナが起動しました。http://localhost:8000 でWordPressにアクセスできます"
	@echo "停止するには 'make down' を実行してください"

# コンテナを停止する（コンテナは保持されます）
down:
	docker-compose stop
	@echo "コンテナを停止しました"

# コンテナを再起動する
restart:
	docker-compose restart

# コンテナのログを表示する
logs:
	docker-compose logs -f

# 実行中のコンテナ一覧を表示
ps:
	docker-compose ps

# WordPressコンテナにシェルで接続
shell:
	docker-compose exec wordpress bash

# MySQLコンテナに接続
db-shell:
	docker-compose exec db mysql -u wordpress_user -ppassword wordpress_db

# コンテナとネットワークを削除（ボリュームとデータは保持）
clean:
	docker-compose down

# コンテナとボリュームを完全に削除（すべてのデータが消えるので注意）
fulldown:
	docker-compose down -v

# コンテナの競合を解決して再起動（名前の競合がある場合に使用）
reset:
	docker rm -f my-wp-db my-wp-site my-wp-phpmyadmin 2>/dev/null || true
	docker-compose up -d

# ヘルプを表示
help:
	@echo "使用可能なコマンド:"
	@echo "  make up        - コンテナをバックグラウンドで起動する"
	@echo "  make down      - コンテナを停止する（データは保持されます）"
	@echo "  make restart   - コンテナを再起動する"
	@echo "  make logs      - コンテナのログを表示する"
	@echo "  make ps        - 実行中のコンテナ一覧を表示"
	@echo "  make shell     - WordPressコンテナにシェルで接続"
	@echo "  make db-shell  - MySQLコンテナに接続"
	@echo "  make clean     - コンテナを削除（データは保持されます）"
	@echo "  make fulldown  - コンテナとデータを完全に削除（すべてリセット）"
	@echo "  make reset     - 既存のコンテナを削除して再起動（名前競合時に使用）"
