USE transactions;
DROP TRIGGER IF EXISTS mail_after_insert_txns;
DELIMITER $$
CREATE TRIGGER mail_after_insert_txns
AFTER INSERT ON transactions.txns
FOR EACH ROW
BEGIN
SET @ret_val = sys_exec(CONCAT ('python /var/www/ssctube/ssctube_ordermail_template.py ', NEW.buyer,' ', NEW.payment_id,' &'));
END$$
DELIMITER ;
