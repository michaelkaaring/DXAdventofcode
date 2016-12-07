defmodule Aoc16.Day03Test do
  use ExUnit.Case, async: true

  test "part 1 example code" do
    assert Aoc16.Day03.is_valid?({5, 10, 25}) == false
  end
end
