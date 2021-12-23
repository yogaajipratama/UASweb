<?php

namespace App\Models\costum;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class dbCreate extends Model
{
    protected $dbName = 'uasdb';


    public function dbExists()
    {
        try {
            DB::connection()->getPdo(); //connection check 
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function dbMake($isBlank = false)
    {
        try {
            DB::disconnect('mysql');
            Config::set('database.connections.mysql.database', ''); //set blank db first
            DB::statement("CREATE DATABASE " . $this->dbName);
            Config::set('database.connections.mysql.database', $this->dbName);
            DB::reconnect();

            $this->up($isBlank);

            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function up($isBlank = true)
    {

        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->integer('user_id', true)->notNull();
                $table->string('username', 20)->unique()->notNull();
                $table->string('email', 50)->unique()->notNull();
                //0 = Super Admin, 1 = Admin, 2 = User Dosen, 3= User Mahasiswa
                $table->tinyInteger('role')->notNull();
                $table->string('password')->notNull();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->integer('student_id', true)->notNull();
                $table->string('nim', 10)->unique()->notNull();
                $table->string('avatar', 255)->nullable();
                $table->string('name', 100)->notNull();
                $table->tinyInteger('sex')->notNull();  //0 = Male, 1 = Female, 2 = Other
                $table->string('email', 50)->unique()->notNull();
                $table->string('tlp', 15)->notNull();
                $table->string('alamat', 255)->nullable();
                $table->date('tglmasuk')->notNull();
                $table->string('kdprodi', 10)->notNull();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->integer('department_id', true)->notNull();
                $table->string('kdprodi', 10)->unique()->notNull();
                $table->string('dept_name', 100)->unique()->notNull();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('lecturers')) {
            Schema::create('lecturers', function (Blueprint $table) {
                $table->integer('lecturer_id', true)->notNull();
                $table->string('nidn', 10)->unique()->notNull();
                $table->string('name', 100)->notNull();
                $table->tinyInteger('sex')->notNull();  //0 = Male, 1 = Female, 2 = Other
                $table->string('tlp', 15)->notNull();
                $table->string('alamat', 255)->notNull();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('subjects')) {
            Schema::create('subjects', function (Blueprint $table) {
                $table->integer('subject_id', true)->notNull();
                $table->integer('department_id')->notNull();
                $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade');
                $table->integer('lecturer_id')->nullable();
                $table->foreign('lecturer_id')->references('lecturer_id')->on('lecturers')->onDelete('set null');
                $table->string('subject_code', 10)->notNull();
                $table->string('subject_name', 100)->notNull();
                $table->tinyInteger('semester')->notNull();
                $table->tinyInteger('sks')->notNull();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (!Schema::hasTable('scores')) {
            Schema::create('scores', function (Blueprint $table) {
                $table->integer('score_id', true)->notNull();
                $table->integer('subject_id')->notNull();
                $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');
                $table->integer('student_id')->notNull();
                $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
                $table->decimal('score', 5, 2)->default(0);
                $table->decimal('pass_score', 5, 2)->default(0);
                $table->enum('score_alpha', array('A', 'B', 'C', 'D', 'E', 'F'))->notNull();
                $table->tinyInteger('pass_stat')->default(0); //0 = Tidak Lulus, 1 = Lulus
                $table->timestamp('created_at')->useCurrent();
            });
        }

        /**
         * SET DEFAULT VALUE
         */
        $sql = "INSERT INTO users (username, email, role, password) VALUES 
                ('SuperAdmin','superadmin@gmail.com',0,'" . bcrypt('SuperAdmin') . "');";
        DB::statement($sql);



        if (!$isBlank) {
            $sql = "INSERT INTO users (username, email, role, password) VALUES 
                    ('Admin','admin@gmail.com',1,'" . bcrypt('Admin') . "'),
                    ('UserDosen','userdosen@gmail.com',2,'" . bcrypt('UserDosen') . "'),
                    ('UserMahasiswa','usermahasiswa@gmail.com',2,'" . bcrypt('UserMahasiswa') . "')
                    ;";
            DB::statement($sql);

            $sql = "INSERT INTO students (nim, name, sex, email, tlp, tglmasuk, kdprodi) VALUES 
                    ('2020081077','UTOROADJI TUNGGUL ANGGORO',0,'xperiasolaji@gmail.com','0818483948','2021-01-01','57201'),
                    ('2020081078','YOGA AJI PRATAMA',0,'yoga@gmail.com','08181234567','2021-01-01','57201'),
                    ('2020081073','JHON ERIKSON',0,'jhon@gmail.com','08187654321','2021-01-01','57201')
                    ;";
            DB::statement($sql);

            $sql = "INSERT INTO departments (kdprodi, dept_name) VALUES 
                    ('62201', 'Akuntansi'),
                    ('23201', 'Arsitektur'),
                    ('90241', 'Desain Komunikasi Visual'),
                    ('90231', 'Desain Produk'),
                    ('70201', 'Ilmu Komunikasi'),
                    ('55201', 'Informatika'),
                    ('61201', 'Manajemen'),
                    ('73201', 'Psikologi'),
                    ('57201', 'Sistem Informasi')
                    ;";
            DB::statement($sql);

            $sql = "INSERT INTO lecturers (nidn, name, sex, tlp, alamat) VALUES 
                    ('123456789', 'Chaerul Anwar, S.Kom, M.T.I.','0','0816840055','UPJ'),
                    ('987654321', 'Rizky Aulia Brilianti, S.Hum., M.Si','1','081818181818','UPJ'),
                    ('123459876', 'Mohamad Johan Budiman, M.Kom','0','08176682091','UPJ')
                    ;";
            DB::statement($sql);

            $sql = "INSERT INTO subjects (department_id, lecturer_id, subject_code, subject_name, semester, sks) VALUES 
                    ('9','1','INS106','Perancangan & Pemrograman Web','2','3'),
                    ('9','2','CPS101','Bahasa Indonesia','1','2'),
                    ('9','3','INS103','Bahasa Pemrograman','1','3')
                    ;";
            DB::statement($sql);
        }
    }

    public function down($isBlank = false)
    {
        $sql = "DROP DATABASE IF EXISTS " . $this->dbName;
        try {
            DB::statement($sql);
            $this->dbMake($isBlank);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}