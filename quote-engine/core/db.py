"""PostgreSQL 연결 헬퍼 (psycopg3)."""
import os
from contextlib import contextmanager
from typing import Optional

import psycopg
from psycopg.rows import dict_row


def _dsn() -> str:
    """환경변수에서 DSN 조립. .env로 DATABASE_URL 직접 줘도 됨."""
    if os.getenv("DATABASE_URL"):
        return os.environ["DATABASE_URL"]
    return (
        f"host={os.getenv('DB_HOST', 'localhost')} "
        f"port={os.getenv('DB_PORT', '5432')} "
        f"dbname={os.getenv('DB_NAME', 'rent_quote')} "
        f"user={os.getenv('DB_USER', 'postgres')} "
        f"password={os.getenv('DB_PASSWORD', '')}"
    )


@contextmanager
def get_conn():
    """with get_conn() as conn: ... 패턴."""
    conn = psycopg.connect(_dsn(), row_factory=dict_row)
    try:
        yield conn
        conn.commit()
    except Exception:
        conn.rollback()
        raise
    finally:
        conn.close()


def fetch_one(sql: str, params: tuple = ()) -> Optional[dict]:
    with get_conn() as conn, conn.cursor() as cur:
        cur.execute(sql, params)
        return cur.fetchone()


def fetch_all(sql: str, params: tuple = ()) -> list[dict]:
    with get_conn() as conn, conn.cursor() as cur:
        cur.execute(sql, params)
        return cur.fetchall()
