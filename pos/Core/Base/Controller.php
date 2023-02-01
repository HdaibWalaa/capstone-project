<?php

namespace Core\Base;

use Core\Model\User;
use Core\Helpers\Helper;


abstract class Controller
{

    abstract public function render();



    protected $view = null;
    protected $data = array();


    protected function view()
    {
        new View($this->view, $this->data);
    }


    protected function auth()
    {

        if (!isset($_SESSION['user'])) {

            Helper::redirect('/');
            exit;
        }
    }


    protected function permissions(array $permissions_set)
    {

        $this->auth();

        $user = new User;

        $assigned_permissions = $user->get_permissions();


        foreach ($permissions_set as $permission) {

            if (!in_array($permission, $assigned_permissions)) {

                if ($_SESSION['user']['role'] == 'seller') {
                    Helper::redirect('/sales');
                } elseif ($_SESSION['user']['role'] == 'accountant') {
                    Helper::redirect('/sales/all_transactions');
                } elseif ($_SESSION['user']['role'] == 'procurement') {
                    Helper::redirect('/items');
                }
            }
        }
    }


    protected function admin_view(bool $switch): void
    {

        if (isset($_SESSION['user']['is_admin_view'])) {

            $_SESSION['user']['is_admin_view'] = $switch;
        }
    }



    protected function htmlspecial(array &$variable)
    {

        foreach ($variable as &$value) {

            if (is_array($value)) {

                $this->htmlspecial($value);
            } else {
                $value = \htmlspecialchars($value);
            }
        }
    }
}
