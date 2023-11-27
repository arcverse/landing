<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127105015 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE shop_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_minecraft_action_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_minecraft_server_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_payment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shop_sold_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE shop_category (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, cumulative BOOLEAN NOT NULL, cumulative_disable_lower BOOLEAN NOT NULL, color VARCHAR(255) DEFAULT NULL, description TEXT NOT NULL, overview TEXT DEFAULT NULL, grid BOOLEAN NOT NULL, order_by_price BOOLEAN NOT NULL, show_in_dropdown BOOLEAN NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DDF4E357727ACA70 ON shop_category (parent_id)');
        $this->addSql('COMMENT ON COLUMN shop_category.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shop_item (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, description TEXT NOT NULL, price INT NOT NULL, remove_after VARCHAR(255) DEFAULT NULL, global_limit INT DEFAULT NULL, one_per_user BOOLEAN NOT NULL, require_only_one BOOLEAN NOT NULL, allow_quantity BOOLEAN NOT NULL, publish_from TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, publish_till TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, hide_on_logout BOOLEAN NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DEE9C36512469DE2 ON shop_item (category_id)');
        $this->addSql('COMMENT ON COLUMN shop_item.remove_after IS \'(DC2Type:dateinterval)\'');
        $this->addSql('COMMENT ON COLUMN shop_item.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shop_item_shop_item (shop_item_source INT NOT NULL, shop_item_target INT NOT NULL, PRIMARY KEY(shop_item_source, shop_item_target))');
        $this->addSql('CREATE INDEX IDX_4292D493B04FCAC ON shop_item_shop_item (shop_item_source)');
        $this->addSql('CREATE INDEX IDX_4292D49312E1AC23 ON shop_item_shop_item (shop_item_target)');
        $this->addSql('CREATE TABLE shop_item_shop_minecraft_server (shop_item_id INT NOT NULL, shop_minecraft_server_id INT NOT NULL, PRIMARY KEY(shop_item_id, shop_minecraft_server_id))');
        $this->addSql('CREATE INDEX IDX_6DB88760115C1274 ON shop_item_shop_minecraft_server (shop_item_id)');
        $this->addSql('CREATE INDEX IDX_6DB88760C2585FBC ON shop_item_shop_minecraft_server (shop_minecraft_server_id)');
        $this->addSql('CREATE TABLE shop_minecraft_action (id INT NOT NULL, item_id INT NOT NULL, trigger VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, require_player_online BOOLEAN NOT NULL, required_inventory_slots INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7E6C8BFD126F525E ON shop_minecraft_action (item_id)');
        $this->addSql('CREATE TABLE shop_minecraft_action_shop_minecraft_server (shop_minecraft_action_id INT NOT NULL, shop_minecraft_server_id INT NOT NULL, PRIMARY KEY(shop_minecraft_action_id, shop_minecraft_server_id))');
        $this->addSql('CREATE INDEX IDX_1F1CD01E472E493E ON shop_minecraft_action_shop_minecraft_server (shop_minecraft_action_id)');
        $this->addSql('CREATE INDEX IDX_1F1CD01EC2585FBC ON shop_minecraft_action_shop_minecraft_server (shop_minecraft_server_id)');
        $this->addSql('CREATE TABLE shop_minecraft_server (id INT NOT NULL, name VARCHAR(255) NOT NULL, secret VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN shop_minecraft_server.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_minecraft_server.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shop_order (id INT NOT NULL, email VARCHAR(255) NOT NULL, ref VARCHAR(255) DEFAULT NULL, aff VARCHAR(255) DEFAULT NULL, minecraft_name VARCHAR(255) NOT NULL, gift_to_minecraft_name VARCHAR(255) DEFAULT NULL, gross INT NOT NULL, net INT NOT NULL, note TEXT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN shop_order.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_order.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shop_payment (id INT NOT NULL, order_ref_id INT NOT NULL, provider VARCHAR(255) NOT NULL, payment_id VARCHAR(255) NOT NULL, amount INT NOT NULL, status VARCHAR(255) NOT NULL, paid_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6E1BC427E238517C ON shop_payment (order_ref_id)');
        $this->addSql('COMMENT ON COLUMN shop_payment.paid_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_payment.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN shop_payment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE shop_sold_item (id INT NOT NULL, order_ref_id INT NOT NULL, item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64341EE7E238517C ON shop_sold_item (order_ref_id)');
        $this->addSql('CREATE INDEX IDX_64341EE7126F525E ON shop_sold_item (item_id)');
        $this->addSql('ALTER TABLE shop_category ADD CONSTRAINT FK_DDF4E357727ACA70 FOREIGN KEY (parent_id) REFERENCES shop_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_item ADD CONSTRAINT FK_DEE9C36512469DE2 FOREIGN KEY (category_id) REFERENCES shop_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_item_shop_item ADD CONSTRAINT FK_4292D493B04FCAC FOREIGN KEY (shop_item_source) REFERENCES shop_item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_item_shop_item ADD CONSTRAINT FK_4292D49312E1AC23 FOREIGN KEY (shop_item_target) REFERENCES shop_item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_item_shop_minecraft_server ADD CONSTRAINT FK_6DB88760115C1274 FOREIGN KEY (shop_item_id) REFERENCES shop_item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_item_shop_minecraft_server ADD CONSTRAINT FK_6DB88760C2585FBC FOREIGN KEY (shop_minecraft_server_id) REFERENCES shop_minecraft_server (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_minecraft_action ADD CONSTRAINT FK_7E6C8BFD126F525E FOREIGN KEY (item_id) REFERENCES shop_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_minecraft_action_shop_minecraft_server ADD CONSTRAINT FK_1F1CD01E472E493E FOREIGN KEY (shop_minecraft_action_id) REFERENCES shop_minecraft_action (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_minecraft_action_shop_minecraft_server ADD CONSTRAINT FK_1F1CD01EC2585FBC FOREIGN KEY (shop_minecraft_server_id) REFERENCES shop_minecraft_server (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_payment ADD CONSTRAINT FK_6E1BC427E238517C FOREIGN KEY (order_ref_id) REFERENCES shop_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_sold_item ADD CONSTRAINT FK_64341EE7E238517C FOREIGN KEY (order_ref_id) REFERENCES shop_order (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shop_sold_item ADD CONSTRAINT FK_64341EE7126F525E FOREIGN KEY (item_id) REFERENCES shop_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE shop_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_minecraft_action_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_minecraft_server_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_payment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shop_sold_item_id_seq CASCADE');
        $this->addSql('ALTER TABLE shop_category DROP CONSTRAINT FK_DDF4E357727ACA70');
        $this->addSql('ALTER TABLE shop_item DROP CONSTRAINT FK_DEE9C36512469DE2');
        $this->addSql('ALTER TABLE shop_item_shop_item DROP CONSTRAINT FK_4292D493B04FCAC');
        $this->addSql('ALTER TABLE shop_item_shop_item DROP CONSTRAINT FK_4292D49312E1AC23');
        $this->addSql('ALTER TABLE shop_item_shop_minecraft_server DROP CONSTRAINT FK_6DB88760115C1274');
        $this->addSql('ALTER TABLE shop_item_shop_minecraft_server DROP CONSTRAINT FK_6DB88760C2585FBC');
        $this->addSql('ALTER TABLE shop_minecraft_action DROP CONSTRAINT FK_7E6C8BFD126F525E');
        $this->addSql('ALTER TABLE shop_minecraft_action_shop_minecraft_server DROP CONSTRAINT FK_1F1CD01E472E493E');
        $this->addSql('ALTER TABLE shop_minecraft_action_shop_minecraft_server DROP CONSTRAINT FK_1F1CD01EC2585FBC');
        $this->addSql('ALTER TABLE shop_payment DROP CONSTRAINT FK_6E1BC427E238517C');
        $this->addSql('ALTER TABLE shop_sold_item DROP CONSTRAINT FK_64341EE7E238517C');
        $this->addSql('ALTER TABLE shop_sold_item DROP CONSTRAINT FK_64341EE7126F525E');
        $this->addSql('DROP TABLE shop_category');
        $this->addSql('DROP TABLE shop_item');
        $this->addSql('DROP TABLE shop_item_shop_item');
        $this->addSql('DROP TABLE shop_item_shop_minecraft_server');
        $this->addSql('DROP TABLE shop_minecraft_action');
        $this->addSql('DROP TABLE shop_minecraft_action_shop_minecraft_server');
        $this->addSql('DROP TABLE shop_minecraft_server');
        $this->addSql('DROP TABLE shop_order');
        $this->addSql('DROP TABLE shop_payment');
        $this->addSql('DROP TABLE shop_sold_item');
    }
}
