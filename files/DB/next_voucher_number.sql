#function for get next voucher number

DROP FUNCTION IF EXISTS GET_NEXT_VOUCHER_NUMBER;

DELIMITER $$
CREATE FUNCTION GET_NEXT_VOUCHER_NUMBER(voucher_id INT) RETURNS VARCHAR(11) DETERMINISTIC
BEGIN
DECLARE next_voucher_number VARCHAR(11);
	SELECT IF (EXISTS ( SELECT 1 FROM account_master WHERE voucher_type_id = voucher_id),
(SELECT MAX(CAST(voucher_number AS SIGNED))+1 FROM account_master WHERE voucher_type_id = voucher_id) ,
(SELECT series_start FROM voucher WHERE voucher_id = voucher_id)) INTO next_voucher_number ;

	RETURN next_voucher_number ;
END$$
DELIMITER ;