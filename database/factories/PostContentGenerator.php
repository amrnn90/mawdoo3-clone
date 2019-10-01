<?php 

namespace FactoryHelpers;
use Faker\Generator as Faker;

class PostContentGenerator {
    private $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function generate()
    {
        $faker = $this->faker; 

        $content = "<h1>{$faker->realText(50)}</h1>"
        . "<p>{$faker->realText(300)}</p>"
        . "<p>{$faker->realText(300)}</p>"
        . "<img src='{$faker->imageUrl()}' />"
        . "<p>{$faker->realText(300)}</p>"
        . "<p>{$faker->realText(300)}</p>"
        . "<blockquote>{$faker->realText(100)}</blockquote>"
        . "<h2>{$faker->realText(50)}</h2>"
        . "<table>
            <thead>
                <tr>
                <td>{$faker->realText(10)}</td>
                <td>{$faker->realText(10)}</td>
                <td>{$faker->realText(10)}</td>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
            </tr>
            <tr>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
            </tr>
            <tr>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
                <td>{$faker->realText(20)}</td>
            </tr>
            </tbody>
            </table>"
        . "<p>{$faker->realText(300)}</p>"
        . "<h3>{$faker->realText(50)}</h3>"
        . "<p>{$faker->realText(300)}</p>"
        . "<h2>{$faker->realText(50)}</h2>"
        . "<p>{$faker->realText(100)}</p>"
        . "<ul>
            <li>{$faker->realText(200)}</li>
            <li>
                {$faker->realText(200)}
                <ul>
                    <li>{$faker->realText(200)}</li>
                    <li>{$faker->realText(200)}</li>
                    <li>{$faker->realText(200)}</li>
                </ul>
            </li>
           </ul>"
        . "<p>{$faker->realText(300)}</p>"
        . "<p>{$faker->realText(300)}</p>";

        return $content;
    }
}