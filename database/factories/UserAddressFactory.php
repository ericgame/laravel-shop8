<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $addresses = [
            ["北京市", "市轄區", "東城區"],
            ["河北省", "石家莊市", "長安區"],
            ["江蘇省", "南京市", "浦口區"],
            ["江蘇省", "蘇州市", "相城區"],
            ["廣東省", "深圳市", "福田區"],
        ];

        $address = $this->faker->randomElement($addresses);

        return [
            'province' => $address[0],
            'city' => $address[1],
            'district' => $address[2],
            'address' => sprintf('第%d街道第%d號', $this->faker->randomNumber(2), $this->faker->randomNumber(3)),
            'zip' => $this->faker->postcode,
            'contact_name' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
