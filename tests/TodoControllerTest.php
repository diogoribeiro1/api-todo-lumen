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
        $model = Todo::factory(5)->create();

        $result = $this->get('/todos');

        $result->assertResponseOk();
        $result->seeJsonStructure(['current_page']);

    }

    public function testUserCanRetrieveASpecificTodo()
    {
        $model = Todo::factory()->create();

        $response = $this->get('/todo/' . $model->id);

        $response->assertResponseOk();
        $response->seeJsonContains(['title' => $model->title]);
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

    public function testUserCanDeleteATodo()
    {
        $model = Todo::factory()->create();

        $response = $this->delete('/todo/' . $model->id);

        $response->assertResponseStatus(204); // 204 = No Content
        $response->notSeeInDatabase('todos',['id' => $model->id]);
    }

    public function testUserShouldDeleteATodoNotExisting()
    {
        $model = Todo::factory()->create();

        $response = $this->delete('/todo/' . 10);

        $response->assertResponseStatus(404); // 204 = No Content
        $response->seeJsonContains(['error' => 'Not Found']);
    }




}
