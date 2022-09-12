<?php

namespace DDForum\Tests;

use DDForum\Core\User;
use DDForum\Core\Database as DB;

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected $pdo;
    protected $user;

    public function setup()
    {
        $this->pdo = DB::instance()->connect("sqlite::memory:");
        $this->createTable();
        $this->fillTable();
        $this->user = new User('test_users');
    }

    protected function createTable()
    {
        DB::instance()->connect($this->pdo);
        $stmt = "CREATE TABLE test_users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username VARCHAR(20) NOT NULL,
            email VARCHAR(20) NOT NULL,
            password VARCHAR(255) NOT NULL,
            level VARCHAR(20) NOT NULL
        )";
        DB::instance()->query($stmt);
        DB::instance()->execute();
    }

    protected function fillTable()
    {
        $user = [
            'id' => 1,
            'username' => 'deondazy',
            'email' => 'deondazy@email.com',
            'password' => password_hash('deondazy', PASSWORD_DEFAULT),
            'level' => 0,
        ];
        DB::instance()->insert('test_users', $user);
    }
    
    public function testUserExists()
    {
        // Check id
        $this->assertTrue($this->user->exist(1));
        
        // Check username
        $this->assertTrue($this->user->exist('deondazy'));
        
        // Check email
        $this->assertTrue($this->user->exist('deondazy@email.com'));
        
        // Unexisting user
        $this->assertFalse($this->user->exist('jamesbond'));
    }
    
    public function testUserFindByName()
    {
        // Existing user
        $user = $this->user->findByName('deondazy');
        $this->assertEquals('deondazy', $user->username);
        
        // Unexisting user
        $user = $this->user->findByName('jamesbond');
        $this->assertNull($user);
    }
    
    public function testUserFindByEmail()
    {
        // Existing user
        $user = $this->user->findByEmail('deondazy@email.com');
        $this->assertEquals('deondazy@email.com', $user->email);
        
        // Unexisting user
        $user = $this->user->findByEmail('jamesbond@email.com');
        $this->assertNull($user);
    }
    
    public function testUserLevelNumberReturnsLevelName()
    {
        // Normal user
        $this->assertEquals('Normal user', $this->user->level(0));
        
        // Administrator
        $this->assertEquals('Administrator', $this->user->level(1));
        
        // Moderator
        $this->assertEquals('Moderator', $this->user->level(2));
        
        // Greater that 2 defaults to normal user
        $this->assertEquals('Normal user', $this->user->level(4));
        
        // Deault: Normal user for string
        $this->assertEquals('Normal user', $this->user->level('string'));
    }
    
    public function testIsUserLogged()
    {
        // Set cookie
        $_COOKIE['ddforum'] = 'deondazy_123hash123';
        $this->assertTrue($this->user->isLogged());
        
        // Unkwon user
        $_COOKIE['ddforum'] = 'jamesbond_123hash123';
        $this->assertFalse($this->user->isLogged());
        
        // Unset cookie
        unset($_COOKIE['ddforum']);
        $this->assertFalse($this->user->isLogged());
    }
    
    public function testCurrentUserId()
    {
        // Set cookie
        $_COOKIE['ddforum'] = 'deondazy_123hash123';
        $this->assertEquals(1, $this->user->currentUserId());
        
        // Unkwon user
        $this->assertNotEquals(2, $this->user->currentUserId());
        
        // Logged out user returns 0
        unset($_COOKIE['ddforum']);
        $this->assertEquals(0, $this->user->currentUserId());
    }
    
    public function testIfUserIsAdmin()
    {
        $_COOKIE['ddforum'] = 'deondazy_123hash123';
        $this->assertFalse($this->user->isAdmin());
        
        // make user an admin
        $this->user->update(['level' => 1], 1);
        $this->assertTrue($this->user->isAdmin());
        
        // Logout user
        unset($_COOKIE['ddforum']);
        $this->assertFalse($this->user->isAdmin());
    }
}


{
    "sync.gist": "6dea835c5b97535c800cb513aebabd2b",
    "php.validate.executablePath": "/Applications/MAMP/bin/php/php7.4.21/bin/php",
    "workbench.colorTheme": "Luvia Theme",
    "workbench.iconTheme": "vscode-great-icons",
    "editor.fontSize": 16,
    "editor.fontFamily": "MonoLisa",
    "editor.fontLigatures": true,
    "workbench.startupEditor": "none",
    "cSpell.userWords": [
        "autoload",
        "PRESALE"
    ],
    "git.enableSmartCommit": true,
    "git.confirmSync": false,
    "editor.inlineSuggest.enabled": true,
    "editor.bracketPairColorization.enabled": true,
    "explorer.confirmDelete": false,
    "editor.detectIndentation": false,
    "editor.wordWrap": "on",
    "files.associations": {
        "*.html": "html",
        "*.css": "css",
        "*.php": "php",
        "*.js": "js"
    },
    "files.autoSave": "afterDelay",
    "gitlens.hovers.currentLine.over": "line",
    "github.copilot.enable": {
        "*": true,
        "yaml": false,
        "plaintext": true,
        "markdown": false
    },
    "git.autofetch": true,
    "liveServer.settings.donotVerifyTags": true,
    "explorer.confirmDragAndDrop": false,
    "emmet.triggerExpansionOnTab": true,
    "emmet.showSuggestionsAsSnippets": true,
    "emmet.useInlineCompletions": true,
    "npm.keybindingsChangedWarningShown": true,
    "alignment.chars": {
    
        ":": {
            "spaceBefore": 0,
            "spaceAfter": 1
        },
        "::": {
            "spaceBefore": 0,
            "spaceAfter": 0
        },
        "=": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "===": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "==": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "=>": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "+=": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "-=": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "*=": {
            "spaceBefore": 1,
            "spaceAfter": 1
        },
        "/=": {
            "spaceBefore": 1,
            "spaceAfter": 1
        }
    }
}

