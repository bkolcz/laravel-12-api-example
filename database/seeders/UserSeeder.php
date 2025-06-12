<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $us = ['user-a', 'mod-user-a', 'user-b', 'user-x'];
        $domains = ["example.com", "example.net", "example.pl"];
        $ns = ['Amelia', 'Adam', 'Roxy', 'Daniel', 'Susanne', 'John', 'Camelia', 'Isabelle', 'Rick', 'Bart'];
        $lns = ['Doe', 'Deming', 'Asti', 'Groomer', 'Irston', 'Hasher', 'Abrand', 'Desmond', 'Romer', 'Hurston'];
        $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 5, 6, 7, 8, 9, 3, 2, 1, 5, 0];
        $prefixes = [48, 31, 25, 1, 8, 32, 76, 71, 77, 65];
        $usernames = array_values(array_map(function ($x) use ($us) {
            return sprintf(
                "%s%s",
                $us[array_rand($us, 1)],
                rand(1, 50000)
            );
        }, array_fill(0, 50, 0)));
        $emails = array_values(array_map(function ($x) use ($us, $domains) {
            return sprintf(
                "%s-%s@%s",
                $us[array_rand($us, 1)],
                rand(1, 50000),
                $domains[array_rand($domains, 1)]
            );
        }, array_fill(0, 50, 0)));
        $names = array_values(array_map(function ($x) use ($ns) {
            return sprintf(
                "%s",
                $ns[array_rand($ns, 1)]
            );
        }, array_fill(0, 50, 0)));
        $lastnames = array_values(array_map(function ($x) use ($lns) {
            return sprintf(
                "%s",
                $lns[array_rand($lns, 1)]
            );
        }, array_fill(0, 50, 0)));
        $phones = array_values(array_map(function ($x) use ($prefixes, $numbers) {
            return sprintf(
                "+%02d%d",
                $prefixes[array_rand($prefixes, 1)],
                implode("", array_map(function ($x)  use ($numbers) {
                    return $numbers[$x];
                }, array_rand($numbers, 9)))
            );
        }, array_fill(0, 50, 0)));
        //
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'username' => $usernames[$i],
                'name' => $names[$i],
                'lastname' => $lastnames[$i],
                'phone' => substr($phones[$i], 0, 12),
                'emails' => json_encode(array_map(function ($x) use ($emails) {
                    return $emails[$x];
                }, array_rand($emails, rand(2, 12)))),
                'extras' => json_encode([]),
                'password' => base64_encode(random_bytes(rand(16, 32)))
            ]);
        }
    }
}
