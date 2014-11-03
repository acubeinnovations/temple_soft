#function for get next voucher number

DROP FUNCTION IF EXISTS GET_NEXT_VOUCHER_NUMBER;

DELIMITER $$
CREATE FUNCTION GET_NEXT_VOUCHER_NUMBER(vid INT) RETURNS INT(11) DETERMINISTIC
BEGIN
DECLARE next_voucher_number INT(11);
	SELECT IF (EXISTS ( SELECT 1 FROM account_master WHERE voucher_type_id = vid),
(SELECT MAX(voucher_number)+1 FROM account_master WHERE voucher_type_id = vid) ,
(SELECT series_start FROM voucher WHERE voucher_id = vid)) INTO next_voucher_number ;

	RETURN next_voucher_number;
END$$
DELIMITER ;