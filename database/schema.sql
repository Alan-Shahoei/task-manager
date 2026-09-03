CREATE TYPE role_name AS ENUM (
    'admin',
    'user'
);

CREATE TYPE task_priority AS ENUM (
    'lowest',
    'low',
    'medium',
    'high',
    'highest'
);

CREATE TABLE users (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE CHECK (email LIKE '%@%'),
    password_hash TEXT NOT NULL,
    profession TEXT NOT NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_ceo BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE roles (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name role_name NOT NULL UNIQUE
);

INSERT INTO roles (name)
VALUES ('admin'), ('user')
    ON CONFLICT (name) DO NOTHING;

CREATE TABLE sections (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name TEXT NOT NULL UNIQUE,
    color VARCHAR(7) NOT NULL DEFAULT '#3B82F6' CHECK (color LIKE '#%'),
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE section_members (
    id BIGINT GENERATED ALWAYS AS IDENTITY primary key,
    user_id BIGINT NOT NULL REFERENCES users(id),
    role_id BIGINT NOT NULL REFERENCES roles(id),
    section_id BIGINT NOT NULL REFERENCES sections(id),
    CONSTRAINT section_members_unique UNIQUE (user_id, role_id, section_id)
);

CREATE TABLE categories (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    section_id BIGINT NOT NULL REFERENCES sections(id),
    name TEXT NOT NULL,
    description TEXT,
    color VARCHAR(7) NOT NULL DEFAULT '#10B981' CHECK(color LIKE '#%'),
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT categories_unique UNIQUE (section_id, name)
);

CREATE TABLE IF NOT EXISTS tasks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    category_id BIGINT NOT NULL REFERENCES categories(id),
    created_by_member_id BIGINT NOT NULL REFERENCES section_members(id),
    title TEXT NOT NULL,
    description TEXT,
    priority task_priority NOT NULL,
    is_done BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    due_at TIMESTAMPTZ NOT NULL,
    submitted_at TIMESTAMPTZ
);

CREATE TABLE IF NOT EXISTS task_assignments (
    section_member_id BIGINT NOT NULL REFERENCES section_members(id),
    task_id BIGINT NOT NULL REFERENCES tasks(id),
    PRIMARY KEY (section_member_id, task_id)
);
