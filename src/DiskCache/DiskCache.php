<?php

namespace DiskCache;

class DiskCache
{
	public $output_dir = 'cache';

	public function initialize()
	{
		if (!is_dir($this->outpur_dir))
		{
			mkdir ($this->outpur_dir, 0777);
		}
	}

	public function set($key, $value)
	{
		return file_put_contents($this->outpur_dir . '/' . $key, $value);
	}

	public function get($key)
	{
		return file_get_contents($this->outpur_dir . '/' . $key);
	}

	public function delete($key)
	{
		if (file_exists($this->outpur_dir . '/' . $key))
		{
			return unlink ($this->outpur_dir . '/' . $key);
		}
	}

	public function delete_group($group)
	{
		foreach (scandir($this->outpur_dir) as $file)
		{
			if (strpos(basename($file), '.') !== false)
			{
				list($group_name, $key) = explode('.', basename($file));

				if ($group_name === $group)
				{
					unlink ($file);
				}
			}
		}

		return;
	}
}