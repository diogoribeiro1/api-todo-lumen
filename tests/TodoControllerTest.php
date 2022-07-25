<?php

namespace Tests;
use App\Models\Todo;
use Laravel\Lumen\Testing\DatabaseMigrations;

class TodoControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserCanCreateATodo()
    {
        //prepare

            $payload = [
                'title' => 'titulo qualquer',
                'description' => 'descrição qualquer'
            ];

        //act

        $result = $this->post('/todo', $payload);

        //assert

        $result->assertResponseStatus(201);
        $result->seeInDatabase('todos', $payload);
    }

    public function testUserCanRetrieveAllTodos()
    {
        $model = Todo::factory()->create();

        $result = $this->get('/todos');

        $result->assertResponseOk();
        $result->seeJsonContains(['title' => $model->title]);
    }

    public function testUserCanRetrieveASpecificTodo()
    {
        $model = Todo::factory()->create();

        $response = $this->get('/todo/' . $model->id);

        $response->assertResponseOk();
        $response->seeJsonContains(['title' => $model->title]);
    }

    public function testUserCanDeleteATodo()
    {
        $model = Todo::factory()->create();

        $response = $this->delete('/todo/' . $model->id);

        $response->assertResponseStatus(204);
        $response->notSeeInDatabase('todos',[
            'id' => $model->id
        ]);
    }

    public function testUserCanUpdateATodo()
    {
        $payload = [
            'title' => 'titulo qualquer',
            'description' => 'descrição qualquer'
        ];

        $model = Todo::factory()->create();

        $response = $this->put('/todo/' . $model->id, $payload);

        $response->assertResponseOk();
        $response->seeJsonContains(['title' => $payload['title']]);
    }
}
