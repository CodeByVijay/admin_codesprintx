<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'John Smith',
                'client_position' => 'Software Engineer',
                'client_company' => 'Tech Solutions Inc.',
                'message' => 'The web development course was absolutely fantastic! The instructors were knowledgeable and the hands-on projects really helped me understand the concepts better.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'client_name' => 'Sarah Johnson',
                'client_position' => 'UI/UX Designer',
                'client_company' => 'Creative Studios',
                'message' => 'I loved the mobile app development course. The curriculum was well-structured and covered everything from basics to advanced topics.',
                'rating' => 5,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'client_name' => 'Michael Chen',
                'client_position' => 'Project Manager',
                'client_company' => 'Digital Agency',
                'message' => 'Great learning experience! The data science course helped me transition into a new career path. Highly recommended!',
                'rating' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'client_name' => 'Emily Davis',
                'client_position' => 'Frontend Developer',
                'client_company' => 'StartupXYZ',
                'message' => 'The ReactJS course was exactly what I needed to level up my skills. The practical approach made it easy to understand complex concepts.',
                'rating' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'client_name' => 'Alex Rodriguez',
                'client_position' => 'Student',
                'client_company' => null,
                'message' => 'As a complete beginner, I found the Python programming course very approachable. The support from instructors was excellent.',
                'rating' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
