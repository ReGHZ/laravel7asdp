1.composer install
2.composer run dev
3 ubah di vendor>laravel>ui>auth-backend->AuthenticatesUsers :

    public function username()
    {
        return 'email'; //ganti ke return 'nik';
    }
    
4. php artisan migrate
5. php artisan db:seed

admin nik 123
password 123456
