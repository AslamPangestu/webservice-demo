<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get("/api/v1/barang/", function (Request $request, Response $response){
    $sql = "SELECT barang.id, barang.name AS nama_barang, kategori.name AS kategori count FROM barang INNER JOIN kategori ON kategori.id = barang.id_kategori";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/api/v1/barang/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT barang.id, barang.name AS nama_barang, kategori.name AS kategori, kategori.id AS id_kategori, count FROM barang INNER JOIN kategori ON kategori.id = barang.id_kategori WHERE barang.id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/api/v1/barang", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("name");
    $sql = "SELECT barang.id, barang.name AS nama_barang, kategori.name AS kategori count FROM barang INNER JOIN kategori ON kategori.id = barang.id_kategori WHERE barang.name LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post("/api/v1/barang/", function (Request $request, Response $response){

    $new_book = $request->getParsedBody();

    $sql = "INSERT INTO barang (name, count, id_kategori ) VALUES (:name, :count, :id_kategori)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":name" => $new_book["name"],
        ":count" => $new_book["count"],
        ":id_kategori" => $new_book["id_kategori"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);

$app->put("/api/v1/barang/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_book = $request->getParsedBody();
    $sql = "UPDATE barang SET name=:name, count=:count, id_kategori=:id_kategori WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":name" => $new_book["name"],
        ":count" => $new_book["count"],
        ":id_kategori" => $new_book["id_kategori"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);

$app->delete("/api/v1/barang/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM barang WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);

$app->get("/api/v1/kategori/", function (Request $request, Response $response){
    $sql = "SELECT * FROM kategori";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/api/v1/kategori/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "SELECT * FROM kategori WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([":id" => $id]);
    $result = $stmt->fetch();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->get("/api/v1/kategori", function (Request $request, Response $response, $args){
    $keyword = $request->getQueryParam("name");
    $sql = "SELECT * FROM kategori WHERE name LIKE '%$keyword%'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $response->withJson(["status" => "success", "data" => $result], 200);
});

$app->post("/api/v1/kategori/", function (Request $request, Response $response){

    $new_book = $request->getParsedBody();

    $sql = "INSERT INTO kategori (name ) VALUES (:name)";
    $stmt = $this->db->prepare($sql);

    $data = [
        ":name" => $new_book["name"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);

$app->put("/api/v1/kategori/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $new_book = $request->getParsedBody();
    $sql = "UPDATE kategori SET name=:name WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id,
        ":name" => $new_book["name"]
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);

$app->delete("/api/v1/kategori/{id}", function (Request $request, Response $response, $args){
    $id = $args["id"];
    $sql = "DELETE FROM kategori WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    
    $data = [
        ":id" => $id
    ];

    if($stmt->execute($data))
       return $response->withJson(["status" => "success", "data" => "1"], 200);
    
    return $response->withJson(["status" => "failed", "data" => "0"], 200);
})->add($cekAPIKey);