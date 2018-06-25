DROP PROCEDURE IF EXISTS propertyList;
DROP FUNCTION IF EXISTS deletePropertyByID;
DROP FUNCTION IF EXISTS insertProperty;


DELIMITER $$

CREATE PROCEDURE addressList()
BEGIN
  SELECT address_id, street1, street2, city FROM address;
END $$
CREATE PROCEDURE propertyList()
BEGIN
    SELECT property_no,
         prop_type,
         rooms,
         rent,
         street1,
         street2,
         city,
         state.name AS sn,
         zip,
         client_no,
         staff_no
      FROM property_for_rent INNER JOIN address USING (address_id)
              INNER JOIN state USING (state_id)
    ORDER BY property_no ASC;
END $$

CREATE PROCEDURE staffList()
BEGIN
  SELECT first_name, person_id FROM person WHERE person_id IN(SELECT person_id FROM staff);
END $$

 CREATE PROCEDURE clientList()
 BEGIN
SELECT first_name, person_id FROM person WHERE person_id IN(SELECT person_id FROM client);
 END $$

CREATE FUNCTION deletePropertyByID (PFR_property_no VARCHAR(5)) RETURNS INT
BEGIN

    -- Declare and initialize variables
    DECLARE v_result INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_result = -1;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;

    -- Delete from any references from the staff or client tables
    -- Note that you cannot delete from client table before deleting any references from property_for_rent table

    SELECT COUNT(*)
    INTO v_row_count_before
    FROM property_for_rent;

    -- property_for_rent
    DELETE FROM property_for_rent WHERE property_no = PFR_property_no;


    SELECT COUNT(*)
    INTO v_row_count_after
    FROM property_for_rent;

    /*
     * Compare the row count before and after.
     * If the difference is 0, then the delete did not succeed
     */
    IF v_row_count_before - v_row_count_after != 0 THEN
        -- Delete succeeded
        SET v_result = 1;
    ELSE
        -- Delete failed
        SET v_result = 0;
    END IF;

  return v_result;
END $$




CREATE FUNCTION insertProperty (propNo VARCHAR(5), pType VARCHAR(15), pRooms VARCHAR(45), pRent INT, pClient VARCHAR(5), fNM VARCHAR(5)) RETURNS INT
BEGIN

  -- Declare and initialize variables
  DECLARE v_address_id INT;
    DECLARE v_result INT;
    DECLARE v_pk_count INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_address_id = -1;
    SET v_result = -1;
    SET v_pk_count = 0;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;

    -- Check if the ID is already used
    SELECT COUNT(*)
    INTO v_pk_count
    FROM   property_for_rent
    WHERE property_no = propNo;

    IF v_pk_count = 0 THEN

        -- Here when the ID is OK
        SELECT COUNT(*)
        INTO v_row_count_before
        FROM property_for_rent;

        -- Create address
        SELECT MAX(address_id) INTO v_address_id FROM address;

        SET v_address_id = v_address_id + 1;

        INSERT INTO property_for_rent (property_no, address_id, prop_type, rooms, rent, staff_no,client_no) VALUE (propNo, v_address_id, pType, pRooms, pRent, fNM, pClient);

        SELECT COUNT(*)
        INTO v_row_count_after
        FROM property_for_rent;

        /*
         * Compare the row count before and after.
         * If the difference is 0, then the indsert did not succeed
         */
        IF v_row_count_after - v_row_count_before = 1 THEN
            -- insert succeeded
            SET v_result = 1;
        ELSE
            -- insert failed
            SET v_result = 0;
        END IF;

    END IF;

    return v_result;
END $$

DELIMITER ;