<?php

/**
 * Class for keeping messages in PDO Sqlite3 database
 */
class DB
{

    public static $conn;

    public static final function get_instance()
    {
        if (!self::$conn) {
            $path = 'sqlite:' . __DIR__ . '/../openai.db';
            self::$conn = new PDO($path);
        }

        return self::$conn;
    }

    public static final function deleteAll() {
        global $conn;

        $sql = "delete from messages";
        $statement = $conn->prepare($sql);
        $ret = $statement->execute();

        return $ret;
    }

    public static final function getMessages($contextId)
    {
        global $conn;
        $rows = [];

        $sql = "
            select 
                m_id,
                m_role,
                m_content
            from
                messages  
            where 
                m_context_id = :context_id
            order by 
                m_id asc
        ";

        $statement = $conn->prepare($sql);
        $statement->execute([':context_id' => $contextId]);
        while ($row = $statement->fetch()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public static final function insertMessage($contextId, $role, $content) {
        global $conn;

        $sql = "
            insert into messages ( m_context_id, m_role, m_content) values (:context_id, :role, :content) 
        ";
        $statement = $conn->prepare($sql);
        $ret = $statement->execute([
            ':context_id' => $contextId,
            ':role' => $role,
            ':content' => $content            
        ]);

        return $ret;
    }

}
