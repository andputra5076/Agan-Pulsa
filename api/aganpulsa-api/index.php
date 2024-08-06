<?php
header("Content-Type: application/json");
require_once 'db.php';

$keyy = date("d/m/Y") . "kontolblackmamba";
if (isset($_GET['key'])) {
    if ($_GET['key'] != md5($keyy)) {
        header("HTTP/1.1 401 Unauthorized");
        die(json_encode(['error' => 'Invalid key']));
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    die(json_encode(['error' => 'Undefined key']));
}


$request_method = $_SERVER["REQUEST_METHOD"];
$table = isset($_GET['table']) ? $conn->real_escape_string($_GET['table']) : '';

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_item($table, $id);
        } else {
            get_items($table);
        }
        break;
    case 'POST':
        add_item($table);
        break;
    case 'PUT':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            update_item($table, $id);
        }
        break;
    case 'DELETE':
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            delete_item($table, $id);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function get_items($table)
{
    global $conn;
    $conditions = [];
    foreach ($_GET as $key => $value) {
        if ($key != 'table' && $key != 'key') {
            $conditions[] = "$key='" . $conn->real_escape_string($value) . "'";
        }
    }
    $where_clause = "";

    if (!empty($conditions)) {
        $where_clause = "WHERE " . implode(" AND ", $conditions);
    }

    $sql = "SELECT * FROM $table $where_clause";
    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

function get_item($table, $id)
{
    global $conn;
    $sql = "SELECT * FROM $table WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["message" => "No record found."]);
    }
}

function add_item($table)
{
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    $columns = implode(", ", array_keys($data));
    $values = implode("', '", array_map([$conn, 'real_escape_string'], array_values($data)));

    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Record created successfully."]);
    } else {
        echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

function update_item($table, $id)
{
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);

    $update_str = "";
    foreach ($data as $key => $value) {
        $update_str .= "$key='" . $conn->real_escape_string($value) . "', ";
    }
    $update_str = rtrim($update_str, ", ");

    $sql = "UPDATE $table SET $update_str WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Record updated successfully."]);
    } else {
        echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

function delete_item($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Record deleted successfully."]);
    } else {
        echo json_encode(["message" => "Error: " . $sql . "<br>" . $conn->error]);
    }
}

$conn->close();
