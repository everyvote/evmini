ALTER TABLE comments ADD COLUMN candidacy_id int(11) unsigned NOT NULL;
CREATE INDEX fk_comments_candidates_ix ON comments (candidacy_id);