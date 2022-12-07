<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $finalName = [
            'Senosios Eišiškių miesto dalys',
            'Zarasų apžvalgos ratas',
            'Labirintų parkas Anykščiuose',
            'Kalitos Kalnas: rogučių, slidinėjimo ir padangų trasos',
            'Dainuvos nuotykių slėnis',
        ];

        $descriptions = [
            'Eišiškės – viena seniausių Lietuvos gyvenviečių. Lietuvos metraštis mini, kad Eišiškes įkūrė žemaičių kunigaikščio Mantvilo sūnus Mikšys. XVI a. buvo laikomos vienu iš svarbiausių LDK miestų. Čia veikė pilies teismas, rinkosi bajorų seimeliai. Miestelyje buvo bažnyčia, sinagoga, mokykla, keturios gatvės, rotušė, smuklė. Dauguma gyventojų buvo žydai, gyvenę čia iki Antrojo pasaulinio karo.',
            '2011 m. atidarytas apžvalgos ratas – analogo Lietuvoje neturintis architektūros statinys. Praeinantiems 17 m. aukščio ratu atsiveria Zaraso ežero panorama. Nusileidus laipteliais žemyn galima keliauti Zaraso ežero pakrantę juosiančiu taku arba patogiai įsitaisyti ant suolelių ir mėgautis vandens telkinio kraštovaizdžiu. Statinio architektas Š. Kiaunė.',
            'Labirintų parkas Anykščiuose – tai unikalus ir vienintelis tokio tipo pramogų parkas ne tik Lietuvoje, bet ir Baltijos šalyse. Čia Jūsų laukia galybė pramogų, kurias išbandyti galės visa šeima! Pagrindinės parko pramogos yra skirtingo dydžio ir sudėtingumo labirintai: Didysis labirintas, Apvalusis ir Lenktynių labirintai, tai po atviru dangumi išsirangę karklų labirintai, kuriuose bus išbandyti Jūsų orientavimosi įgūdžiai ir kantrybė. Didysis karklų labirintas nuo 2021 m. Rekordų akademijos pripažintas didžiausias ir vienintelis toks labirintas Lietuvoje. Jo takų ilgis siekia net 951 m.',

            '„Dainuvos Nuotykių Slėnis“- tai pramogų parkas įsikūręs Anykščių šilelio prieglobstyje, ant Šventosios upės kranto. Tai geriausia vieta ekstremalių pojūčių mėgėjams aktyviai praleisti laiką ir pasimėgauti gamta. Mūsų parko lankytojai keliaudami nuo medžio ant medžio, įveikdami lengvas ir sudėtingas trasas patirs neišdildomų įspūdžių ir pasikraus gerų emocijų.',
            'Pagauk vėją Anykščių Kalitos kalne
            Rogučių trasa – tai vienintelis toks atrakcionas Lietuvoje – viliojantis nusileisti linksmaisiais kalneliais ir pajusti naujas bei netikėtas emocijas.
            Rogutės veikia visus metus – tiek vasarą, tiek žiemą. 500 metrų ilgio trasa, kurioje yra 5 posūkiai, tramplynas ir kilpa. Prisisekite saugos diržus ir pagaukite vėją skriedami nuo Kalitos kalno!
            Atrakcionas "VIRTUALI REALYBĖ". Pasinerk į virtualų nuotykių pasaulį ir patirk neįtikėtinus pojūčius!
            Manevringa, sinchroniškai su vaizdu judanti sėdima platforma 2 asmenims su virtualios realybės akiniais. Siekiant pajusti kiek galima stipresnį papildytos realybės efektą, integruota speciali garso sistema bei įvairūs efektai.
            Šaltuoju metų laiku, Kalitos kalnas pritaikomas kalnų slidinėjimui. Čia žiemą įrengiamos 4 trasos, kurių ilgis svyruoja nuo 200 iki 400 metrų. Taip pat sniego parkas su atskiru keltuvu, kuriame savo jėgas gali išbandyti ekstremalūs snieglentininkai ar slidininkai. Į Kalitos kalną užkelia 5 keltuvai (atskiru keltuvu keliami tik vaikai ir pradedantieji), o neturintieji slidinėjimui reikalingos įrangos visada gali ją išsinuomoti vietoje',

        ];

        $longitudes = [
            54.16941,
            55.728041,
            55.480429,
            55.525488,
            55.514455,
        ];

        $platitudes = [
            24.99584,
            26.243556,
            25.080072,
            25.125234,

            25.081076
        ];

        for ($i = count(Location::all()); $i < count($finalName); $i++) {
            return [
                'title' => $finalName[$i],
                'description' => $descriptions[$i],
                'longitude' => $longitudes[$i],
                'latitude' =>   $platitudes[$i],
                'image_name' => 'location' . $i,
                'image_path' => 'images/locations/location' . count(Location::all()),
            ];
        }

        // return [
        //     'title' => $finalName[count(Location::all())],
        //     'description' => $descriptions[count(Location::all())],
        //     'longitude' => $longitudes[count(Location::all())],
        //     'latitude' =>   $platitudes[count(Location::all())],
        //     'image_name' => 'location' . count(Location::all()),
        //     'image_path' => 'images/locations/location' . count(Location::all()),
        // ];


    }
}
