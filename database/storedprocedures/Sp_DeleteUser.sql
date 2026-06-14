DELIMITER $$

DROP PROCEDURE IF EXISTS sp_DeleteUser$$

CREATE PROCEDURE sp_DeleteUser(
    IN p_id INT
)
BEGIN
    -- Удаляем пользователя с указанным ID
    DELETE FROM Users
    WHERE Id = p_id;

    -- Возвращаем количество затронутых строк
    SELECT ROW_COUNT() AS affected_rows;
END$$

DELIMITER ;