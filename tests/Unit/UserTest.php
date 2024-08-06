<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use PHPUnit\Framework\Attributes\Test;


class UserTest extends TestCase
{
use RefreshDatabase;

    #[Test]
public function it_creates_a_user()
{
    // Crear un usuario
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'image_path' => 'path/to/image.jpg', // Este campo es nullable
    ]);

    // Verificar que el usuario fue creado en la base de datos
    $this->assertDatabaseHas('users', [
    'email' => 'john@example.com',
    ]);
}

#[Test]
    public function it_requires_email_to_be_unique()
{
    // Crear un primer usuario
    User::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'image_path' => 'path/to/image2.jpg',
    ]);

    // Intentar crear un segundo usuario con el mismo email
    $this->expectException(QueryException::class);

    User::create([
        'name' => 'John Smith',
        'email' => 'jane@example.com',
        'image_path' => 'path/to/image3.jpg',
    ]);
}
#[Test]
    public function it_allows_nullable_image_path()
    {
    // Crear un usuario sin imagen
        $user = User::create([
        'name' => 'No Image User',
        'email' => 'noimage@example.com',
        ]);

        // Verificar que el campo image_path sea null
        $this->assertDatabaseHas('users', [
        'email' => 'noimage@example.com',
        'image_path' => null,
        ]);
    }

#[Test]
    public function it_can_update_a_user()
    {
        // Crear un usuario
        $user = User::create([
        'name' => 'Update User',
        'email' => 'update@example.com',
        'image_path' => 'path/to/oldimage.jpg',
        ]);

    // Actualizar el usuario
        $user->update([
        'name' => 'Updated Name',
        'image_path' => 'path/to/newimage.jpg',
        ]);

        // Verificar que los cambios se hayan guardado
        $this->assertDatabaseHas('users', [
        'email' => 'update@example.com',
        'name' => 'Updated Name',
        'image_path' => 'path/to/newimage.jpg',
        ]);
    }
}
