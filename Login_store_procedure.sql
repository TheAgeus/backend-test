DELIMITER $$

CREATE PROCEDURE buscar_usuario_y_contraseña (
    IN p_nombre_usuario VARCHAR(50),
    IN p_contraseña VARCHAR(50)
)
BEGIN
    DECLARE v_usuario_encontrado VARCHAR(50);
    DECLARE v_rol VARCHAR(50);
    DECLARE p_token VARCHAR(100);
    DECLARE p_rol VARCHAR(50);
    
    SET v_usuario_encontrado = NULL;

    -- Buscar el usuario y la contraseña en la base de datos
    SELECT usuario, rol INTO v_usuario_encontrado, v_rol
    FROM usuarios
    WHERE usuario = p_nombre_usuario AND password = p_contraseña;

    -- Si el usuario y la contraseña se encontraron, generar un token nuevo
    IF v_usuario_encontrado IS NOT NULL THEN
        SET p_token = CONCAT('token_', UUID());
        
        -- Agregar el token a la tabla de tokens
        INSERT INTO tokens (usuario, token)
        VALUES (v_usuario_encontrado, p_token);
    END IF;

    -- Devolver el token y el rol
    IF v_usuario_encontrado IS NOT NULL THEN
        SET p_rol = v_rol;
    ELSE
        SET p_token = NULL;
        SET p_rol = NULL;
    END IF;
    
    SELECT p_rol, p_token, p_rol;
END;

$$

DELIMITER ;

CALL `buscar_usuario_y_contraseña`('ageus', '0309')