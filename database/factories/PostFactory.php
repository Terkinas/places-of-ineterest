<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNames = [
            "Nu neblogas",
            "patiko",
            "gerulis, sitos firmos man geriausi",
            "Labai patiko :)",
            "Radau sau tinkamiausia",
            "Ir nebrangu ir skanu",
            "Aciu, pabandėm ir patiko",
            "Skanus",
            "Oho, šitas pats tas",
            "Omg baikit, paliksiu savo alga visa",
            "ople, nustebino",
            "Geras, aciu",
            "Patiko, ačiū",
            "Pirksiu dar :)",
            "Visai nieko toks",
            "Man kaip tik",
            "geras, rekomenduoju",
            "Paliko gerą įspudį",
            "neišpirkit, nes imsiu dar :D",
            "Opa",
            "Geruls",
            "aciu",
            "Ačiu, greitai gavau",
            "Retai rašau atsiliepimus",
            "išties neblogas",
            "Toks kokio ir tikėjaus :d"

        ];

        $date = mt_rand(1641580469, 1659897269);

        $finalName = [
            'e94a70993503ec14d5ce230b9b4f434a.jpg',
            'trijumergeliutiltasselfie.jpg',
            '296447620_0c62f71758.jpg',
            '17126542_zajq-ZKULEblX4raJMYBalam2dhBciuNCZfneSbMx7E.jpg',
            'DSCF4731.jpg',
            'kadagiu-slenis-22571.jpg',
            'Uostas_2.jpg',
            'images_straipsniu_foto_3672_forta_kn_120700_e01_bra.jpg',
            'nt50h.jpg',
            'IMGP3110.jpg',
            'medziu-laju-takas-anyksciuose-68654218.jpg',
            '637_f1f36fde9378092926bad9d133cc8a26.jpg',
            'Dubravos-rezervatinės-apyrubės-apžvalgos-takas-is-www.jpg',
            'imgp5741.jpg',

        ];

        return [
            'image_name' => $finalName[rand(0, count($finalName) - 1)],
            'image_title' => $randomNames[rand(0, count($randomNames) - 1)],
            'image_path' => 'images/location/lietuva/' . $finalName[rand(0, count($finalName) - 1)],
            'location_id' => 1,
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s", $date),
        ];
    }
}
